# Imagens do projeto funcionando

![Dashboard](crud-faturas/img/dashboard.png)

![Dashboard](crud-faturas/img/faturas.png)

![Dashboard](crud-faturas/img/clients.png)

# CRUD-Faturas • Guia de Instalação & Uso

Sistema em **PHP 8** (pura), **MySQL** e **Bootstrap 5** para gerenciar Clientes, Faturas, Linhas de Fatura, upload de PDF e um painel com métricas e gráfico em tempo real.

---

## ⚙️ 1. Pré-requisitos

| Requisito    | Versão mínima | Observações                                             |
| ------------ | ------------: | ------------------------------------------------------- |
| **PHP**      |           8.1 | Habilitar extensões `pdo_mysql`, `fileinfo`             |
| **XAMPP**    |           8.x | Inclui Apache + MySQL + PHP num só instalador           |
| **Composer** |             — | Só para instalar dependências futuras; projeto roda sem |

> **Windows**
> • Baixe XAMPP em [https://www.apachefriends.org](https://www.apachefriends.org).
> • Instale em `C:\xampp`, abra o **XAMPP Control Panel** e inicie **Apache** e **MySQL**.

---

## 🗄️ 2. Banco de Dados

1. Abra **phpMyAdmin** (`http://localhost/phpmyadmin`) ou terminal MySQL.
2. Execute o script abaixo para criar DB e tabelas:

```sql
CREATE DATABASE crud_faturas
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE crud_faturas;

CREATE TABLE clients (
  id INT AUTO_INCREMENT PRIMARY KEY,
  razao_social  VARCHAR(191) NOT NULL,
  nome_fantasia VARCHAR(191) NOT NULL,
  cnpj          CHAR(14)     NOT NULL UNIQUE,
  created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE invoices (
  id INT AUTO_INCREMENT PRIMARY KEY,
  client_id       INT NOT NULL,
  due_date        DATE NOT NULL,
  total_value     DECIMAL(10,2) NOT NULL,
  reference       DATE NOT NULL,
  contract_number VARCHAR(50),
  operator        VARCHAR(50),
  pdf_path        VARCHAR(255),
  created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_invoice_client
    FOREIGN KEY (client_id) REFERENCES clients(id)
    ON DELETE CASCADE
);

CREATE TABLE invoice_lines (
  id INT AUTO_INCREMENT PRIMARY KEY,
  invoice_id  INT NOT NULL,
  line_number VARCHAR(20) NOT NULL,
  line_value  DECIMAL(10,2) NOT NULL,
  CONSTRAINT fk_line_invoice
    FOREIGN KEY (invoice_id) REFERENCES invoices(id)
    ON DELETE CASCADE
);
```

---

## 📂 3. Instalação do Projeto

1. **Clone ou copie** a pasta para o XAMPP:

```
C:\xampp\htdocs\crud-faturas
```

2. Crie a pasta de uploads e dê permissão de escrita:

```
mkdir C:\xampp\htdocs\crud-faturas\public\uploads
```

3. **Configuração**
   Edite `config/config.php` caso seu MySQL use usuário/senha diferentes de `root`/\`\` (vazio).

---

## ▶️ 4. Executando

### 4.1 Via Apache/XAMPP (recomendado)

1. No **XAMPP Control Panel** mantenha Apache & MySQL em **Running**.
2. Navegue até:

```
http://localhost/crud-faturas/public/
```

*(O arquivo `.htaccess` faz o roteamento amigável.)*

### 4.2 Via servidor embutido do PHP (opcional)

```bash
cd C:\xampp\htdocs\crud-faturas
php -S localhost:8000 -t public
```

Acesse [http://localhost:8000/](http://localhost:8000/).

---

## 🖱️ 5. Navegação Rápida

| Menu          | O que faz                                                                                         |
| ------------- | ------------------------------------------------------------------------------------------------- |
| **Dashboard** | Cards com totais de Clientes, Faturas e Valor; gráfico de receita dos últimos 6 meses (Chart.js). |
| **Clientes**  | CRUD completo + busca instantânea por ID, Razão Social, Nome Fantasia ou CNPJ.                    |
| **Faturas**   | Listagem com filtros (cliente, referência YYYY-MM, operadora), upload de PDF, link para Linhas.   |
| **Linhas**    | Telefone mascarado e valor com máscara de moeda (Cleave.js).                                      |

---

## 🛠️ 6. Erros Comuns & Soluções

| Mensagem                                                 | Causa / Correção                                                                                                      |
| -------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------- |
| **PDOException: could not find driver**                  | Extensão `pdo_mysql` não habilitada. Edite `php.ini`, descomente `extension=pdo_mysql`, reinicie Apache.              |
| **Permission denied ao fazer upload**                    | Pasta `public/uploads` sem permissão. Crie e dê permissão de escrita.                                                 |
| **Class … not found**                                    | Arquivo ausente em `app/Controllers/…` ou namespace errado. Verifique se o nome do arquivo e o namespace batem.       |
| **Bad Request / 404** ao acessar `/crud-faturas/public/` | `.htaccess` ignorado. Confirme que o módulo `mod_rewrite` está habilitado no Apache (`httpd.conf`).                   |
| **Valores decimais gravados como 0**                     | Locale diferente. Certifique-se de que o input usa vírgula e o PHP converte com `str_replace(['.', ','], ['', '.'])`. |

---

> Projeto criado para demonstrar conhecimentos em **PHP 8**, **PDO**, **MVC**, **AJAX/Fetch**, **Chart.js** e **Bootstrap**.
> Sinta-se à vontade para abrir issues ou melhorar o código!
