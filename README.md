## Teste para vaga back-end laravel

### Instalação
Apenas fazer o clone do projeto e possuir PHP e o composer instalado na maquina, ao clonar o projeto, vá ao diretorioro raíz do mesmo e execute o comando:
composer install. Após isso deve-se configurar as variáveis de ambiente, criando o arquivo ".env", para isto basta criar um arquivo chamado ".env" e copiar e colar o conteúdo de ".env.example" e colocar os valores referentes a conexão com banco, redis e email. 

### Execução do projeto 
basta apenas executar "php artisan serve" na raíz do projeto e o mesmo estará sendo executado na porta 8000.

### Resolução do teste
Basicamente se trata de uma aplicação com vários CRUDS e uma ou outra regra de negócio básica, então busquei muito reaproveitamente de código usando repositories e traits, praticamente em todos os controllers as funções de acesso ao banco de dados são reaproveitadas passando apenas o model em questão, o maior desafio foi a fila e os testes, os quais ainda estudo bastante sobre.
