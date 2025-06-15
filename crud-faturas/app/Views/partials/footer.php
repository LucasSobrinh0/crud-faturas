<script src="https://cdn.jsdelivr.net/npm/cleave.js@1/dist/cleave.min.js"></script>
<script>
  new Cleave('.money', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand',
    numeralDecimalMark: ',',
    delimiter: '.',
    numeralDecimalScale: 2
  });
new Cleave('.phone', {
    delimiters: ['(', ') ', '-'],
    blocks:     [0, 2, 5, 4],
    numericOnly: true
  });
</script>
<script>
(() => {
  const input  = document.querySelector('input[name="q"]');
  const tbody  = document.getElementById('client-body');
  let   timer  = null;

  // helper p/ montar cada linha
  const row = c => `
    <tr>
      <td>${c.id}</td>
      <td>${escapeHtml(c.razao_social)}</td>
      <td>${escapeHtml(c.nome_fantasia)}</td>
      <td>${formatCnpj(c.cnpj)}</td>
      <td>
        <a class="btn btn-outline-primary"
           href="/?controller=client&action=edit&id=${c.id}">Editar</a>
        <a class="btn btn-outline-danger"
           href="/?controller=client&action=delete&id=${c.id}"
           onclick="return confirm('Confirma excluir?')">Excluir</a>
      </td>
    </tr>`;

  // pequenos auxiliares
  function escapeHtml(str){
     return str.replace(/[&<>"']/g, s =>
       ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[s]));
  }
  function formatCnpj(c){
     return c.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/, '$1.$2.$3/$4-$5');
  }

  // disparo com debounce
  input.addEventListener('input', () => {
     clearTimeout(timer);
     timer = setTimeout(()=>load(input.value), 300);
  });

  function load(q){
     fetch(`?controller=client&action=json&q=${encodeURIComponent(q)}`)
       .then(r => r.json())
       .then(list => {
          tbody.innerHTML = list.map(row).join('');
       });
  }
})();
</script>
<script>
(() => {
  const cliente   = document.getElementById('f-cliente');
  const referencia= document.getElementById('f-ref');
  const operadora = document.getElementById('f-operadora');
  const tbody     = document.getElementById('invoice-body');
  let   timer;

  /* helpers ---------------------------------------------------- */
  const eHtml = s => s.replace(/[&<>"']/g,
    t => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[t]));
  const fmtCNPJ = c => c.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/,
                                 '$1.$2.$3/$4-$5');
  const fmtDate = d => {
        const [y,m] = d.split('-');              // recebe YYYY-MM-01
        return `${y}-${m}`;                      // mostra YYYY-MM
  };
  const money = n => Number(n).toLocaleString('pt-BR',
                   {minimumFractionDigits:2, maximumFractionDigits:2});

  const row = i => `
    <tr>
      <td>${eHtml(i.nome_fantasia)}</td>
      <td>${fmtCNPJ(i.cnpj)}</td>
      <td>${eHtml(i.operator ?? '')}</td>
      <td>${fmtDate(i.reference)}</td>
      <td>${new Date(i.due_date).toLocaleDateString('pt-BR')}</td>
      <td class="text-end">R$ ${money(i.total_value)}</td>
      <td>
         <a class="btn btn-outline-primary"
            href="?controller=invoice&action=edit&id=${i.id}">Editar</a>
         ${i.pdf_path
            ? `<a class="btn btn-outline-dark" target="_blank"
                 href="/${i.pdf_path}">Documento</a>`
            : '<span class="badge text-bg-secondary">—</span>'}
         <a class="btn btn-outline-danger"
            href="?controller=invoice&action=delete&id=${i.id}"
            onclick="return confirm('Confirma excluir?')">Excluir</a>
      </td>
      <td>
        <a class="btn btn-primary"
           href="?controller=invoiceline&action=index&id=${i.id}">
           Ver linhas
           ${i.line_count ? `<span class="badge bg-light text-dark">${i.line_count}</span>` : ''}
        </a>
      </td>
    </tr>`;

  /* debounce listener ----------------------------------------- */
  [cliente, referencia, operadora].forEach(inp =>
    inp.addEventListener('input', () => {
      clearTimeout(timer);
      timer = setTimeout(load, 300);
    })
  );

  function load(){
     const params = new URLSearchParams({
       controller : 'invoice',
       action     : 'json',
       cliente    : cliente.value,
       referencia : referencia.value,
       operadora  : operadora.value
     });
     fetch('?'+params.toString())
       .then(r => r.json())
       .then(list => { tbody.innerHTML = list.map(row).join(''); });
  }
})();
</script>
</body>
</html>
