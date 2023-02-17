
## Instalação do projeto

- O projeto foi criado em um sistema operacional linux.

- Confirme se as portas configuradas nos arquivos .env e docker-compose.yaml não estão sendo utilizadas em sua maquina. 

- Para instalar você precisa clonar esse repositório em sua maquina, após acesse a pasta do projeto Kanastra, em seguida execute o comando docker-compose up --build. Essa instalação pode levar alguns minutos.

- Finalizando a instalação rode o comando php artisan migrate

- Execute os comandos npm install, npm run build e npm run dev

- Caso você não tenha alterado nenhuma porta, acessando http://localhost:8091/ o projeto estará disponivel.

- Para testar o disparo de e-mail e o visualizar o boleto, sugiro que utilize o serviço do mailtrap (https://mailtrap.io/home)

- Para utilizar o serviço de e-mail no arquivo .env configure seus dados de MAIL_MAILER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, MAIL_ENCRYPTION de acordo com o mailtrap (fazer uma conta la, caso não tenha).

- Tudo pronto, agora você pode testar o sistema!

- A api para retorno bancario será a url que está rodando o projeto na sua maquina, acrescida de /api/return/bank

- exemplo -> http://localhost:8091/api/return/bank

