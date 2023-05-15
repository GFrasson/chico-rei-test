# Chico Rei - Teste técnico
Recriar uma funcionalidade do site da Chico Rei, como um catálogo de produtos com filtro e paginação.

## Tecnologias Utilizadas
- Laravel
- Vue.js
- Mysql
- Less
- Axios
- Guzzle

## Consumo de API
- [Link para API](https://rapidapi.com/okami4kak/api/scrapingant/)

## Build

 - Clone o repositório
```bash
git clone https://github.com/GFrasson/chico-rei-test
```

 - Crie um arquivo `.env` na raiz do projeto
 - Copie todo o conteúdo do arquivo `.env.example` e cole no arquivo `.env`
 - Preencha a variável `RAPID_API_KEY` no arquivo `.env` com a chave para consumo da API
 - Crie um banco de dados Mysql (sugestão de nome já preenchido nas variáveis ambiente: `chico_rei_test`)
 - Substitua as variáveis com os dados para a conexão com o banco Mysql criado:

```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=chico_rei_test  # Nome da base de dados criada
DB_USERNAME=root            # Nome de usuário
DB_PASSWORD=                # Senha
```

 - Instale as dependências com os comandos
```bash
composer install
npm install
```

 - Execute o comando para gerar uma key salva no arquivo `.env`
```bash
php artisan key:generate
```

 - Rode as migrations
```bash
php artisan migrate:fresh
```

## Execução

 - Em terminais separados rode os seguintes comandos:
```bash
npm run dev
```

```bash
php artisan serve
```

## Observação

Na primeira execução do projeto, a aplicação consome a API buscando os dados do site da Chico Rei. Entretanto, a API é um pouco lenta e esse processo de buscar os dados pode demorar um pouco dependendo da sua conexão e processamento (uma média de aproximadamente 30 segundos). Após esse primeiro acesso, todos os dados necessários são salvos no banco de dados e, assim, nos próximos acessos o tempo de espera é reduzido consideravelmente.
