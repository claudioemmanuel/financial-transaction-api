## 🖥 Tecnologias
#### `Back-end`
- [Laravel](https://laravel.com/)
#### para executar a aplicação sera necessário o [Composer](https://getcomposer.org/download/)

## 🎴 Como Usar?

Instalação do projeto
```bash
$ composer install
```

#### Após copie/duplique o arquivo .env.example e renomeie para .env configurando com suas variáveis de ambiente de banco
Insira as 2 variáveis de ambiente abaixo ao final do arquivo .env configurado anteriormente
```bash
API_AUTHORIZE_TRANSACTION = https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6
API_NOTIFICATION = http://o4d9z.mocklab.io/notify
```
Execute o comando abaixo para popular o banco com os usuários
```bash
$ php artisan migrate:fresh --seed
```

Execute o comando para instalação do [Laravel Passport](https://laravel.com/docs/8.x/passport) para camada de segurança da API
```bash
php artisan passport:install --force
```

Inicie o servidor para testes na API via Postman ou Insomnia
```bash
php artisan serve
```

## 💻 Insomnia
Caso queira utilizar o Insomnia, basta importar o arquivo em **docs/Insomnia.json** para testar API.

## 🔗 Routes 
#### /register - POST para criar o usuário na API

Exemplo de usuário comum 
```bash
curl --request POST \
  --url http://127.0.0.1:8000/api/register \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' \
  --data '{
	"user_type_id": "1",
	"name": "Claudio Emmanuel de Araujo Souza",
	"cpf_cnpj": "094.312.736-08",
	"email": "claudio@claudio.com.br",
	"password": "123456"
}'
```
Exemplo de usuário lojista 
```bash
curl --request POST \
  --url http://127.0.0.1:8000/api/register \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' \
  --data '{
	"user_type_id": "2",
	"name": "Emmanuel Lino de Souza",
	"cpf_cnpj": "74.208.195\/0001-04",
	"email": "emmanuel@emmanuel.com.br",
	"password": "123456"
}'
```

#### /login - POST para logar na API e receber o token de autorização

Exemplo a ser enviado
```bash
curl --request POST \
  --url http://127.0.0.1:8000/api/login \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' \
  --data '{
	"email": "claudio@claudio.com.br",
	"password": "123456"
}'
```

#### /transaction - POST para efetuar a transação de valores entre usuários
Substitua o token retornado na rota /login em {SEU TOKEN AQUI} para autorização da transação sem o token você não estará logado e apto a efetuar transferências na API

Exemplo a ser enviado
```bash
curl --request POST \
  --url http://127.0.0.1:8000/api/transaction \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer {SEU TOKEN AQUI}' \
  --header 'Content-Type: application/json' \
  --data '{
	"value": 10,
	"payee": 4
}'
```

## 📙 Licença
> Com base nos termos de [MIT LICENSE](https://opensource.org/licenses/MIT)

##### Feito por Claudio Emmanuel com ❤️
