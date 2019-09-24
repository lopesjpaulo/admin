# DESCRIÇÃO DO PROJETO

O projeto consiste no desenvolvimento de um painel para a administração de sites e sistemas usando o Laravel integrado com o AdminLTE.

## Tecnologias utilizadas

**1.Server-side**

- PHP >= 7.1
- MySQL
- Laravel Framework

**2.Client-side**

- Template AdminLTE
- Javascript

## Instruções 

1. Clonar o projeto para sua máquina com **git clone https://github.com/lopesjpaulo/admin.git**
3. Rodar **composer install** para instalar as dependências do server-side.
4. Modificar o arquivo **.env** com os dados de conexão do seu banco de dados local.
5. Executar o comando **copy .env.example .env** para criar o arquivo **.env** na pasta.
6. Executar o comando **php artisan key:generate** para gerar a chave do app.
5. Rodar **php artisan migrate** para executar as migrations e criar as tabelas do banco de dados.
6. Ao criar uma nova funcionalidade, criar um novo branch com o comando **git checkout -b 'nome da funcionalidade'**. 
7. Após todos os testes da nova funcionalidade, fazer o **pull** do repositório para verificar se houve alguma mudança antes do merge.
8. Após o pull e resolução de possíveis conflitos, fazer o merge para a branch **develop**.
9. O código será então revisado e será feito o merge para a branch **master**, que é a branch de produção
e que estará sendo usada no servidor no momento.
10. Caso haja necessidade, executar o comando **php artisan storage:link** para criar um link
simbólico de acesso aos arquivos e imagens.

## Autoria e contribuições

- João Paulo Lopes: Back-end e DBA [lopesjpaulo](https://github.com/lopesjpaulo)
