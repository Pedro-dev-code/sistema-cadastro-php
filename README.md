# ✅ Gerenciador de Tarefas

Aplicação web com cadastro e login de usuários, onde cada pessoa gerencia as próprias tarefas (CRUD completo).

## Tecnologias
PHP (PDO), MySQL, HTML e CSS.

## Funcionalidades
- Cadastro e login com senha criptografada (`password_hash`)
- Criar, listar, editar, concluir e excluir tarefas
- Filtro por status (todas, pendentes, concluídas)
- Cada usuário só acessa as suas tarefas

## Segurança aplicada
- Consultas preparadas com PDO (protege contra SQL injection)
- Saída escapada com `htmlspecialchars` (protege contra XSS)
- Ações de alteração via POST e verificação de dono da tarefa

## Como rodar
1. Instale o [XAMPP](https://www.apachefriends.org/) e inicie **Apache** e **MySQL**.
2. Copie esta pasta para `htdocs/`.
3. No phpMyAdmin, importe o arquivo `database.sql`.
4. Ajuste usuário e senha do banco em `config.php`, se necessário.
5. Acesse `http://localhost/gerenciador-tarefas-php/register.php`.

## Próximos passos
- Proteção CSRF nos formulários
- Prazo e prioridade nas tarefas
- Paginação da lista
