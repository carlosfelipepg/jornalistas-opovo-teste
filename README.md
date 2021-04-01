## Sobre o projeto

Projeto criado com o intuito de gerenciar notícias feitas por determinados jornalistas

- Registro de jornalista e autenticação
- Criação de notícias por jornalista
- Criação dos tipos de notícias
- Filtros para as noticías

### Tecnologias usadas

- **[Laravel](https://laravel.com/)**
- **[PHP](https://www.php.net/)**
- **[Mysql](https://www.mysql.com/)**
- **[JWT](https://jwt.io/)**

### URLs
#### Jornalistas
- #### POST /api/register
- #### POST /api/login
- #### GET /api/me

#### Notícias
- #### POST /api/news/create
- #### POST /api/news/update/{id}
- #### POST /api/news/delete/{id}
- #### GET /api/news/me
- #### GET /api/news/type/{type_id}

#### Tipos Notícias
- #### POST /api/type/create
- #### POST /api/type/update/{id}
- #### POST /api/type/delete/{id}
- #### GET /api/type/me
