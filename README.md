# **API de Sistema de Sorteios para Igrejas**

Este repositório contém uma API desenvolvida para criar e gerenciar sorteios específicos para igrejas. A API permite aos membros da comunidade participar de sorteios transparentes e visualizar os resultados de forma imparcial e eficiente. Abaixo estão as etapas para configurar e executar a API em seu ambiente local.

## **Instruções de Instalação:**

1. **Clonar o Repositório:**

    Clone este repositório em sua máquina local usando o comando:

    ```bash

    git clone https://github.com/seu-usuario/nome-do-repositorio.git

    ```

2. **Configuração do Banco de Dados:**

    Configure as credenciais do banco de dados no arquivo **`.env`**. Certifique-se de que as configurações de **`DB_HOST`**, **`DB_PORT`**, **`DB_DATABASE`**, **`DB_USERNAME`** e **`DB_PASSWORD`** estejam corretas.

3. **Executar Migrações:**

    Execute o seguinte comando para criar as tabelas no banco de dados:

    ```bash

    php artisan migrate

    ```

4. **Popular o Banco de Dados (Opcional):**

    Se desejar, você pode popular o banco de dados com dados de exemplo usando o comando:

    ```bash

    php artisan db:seed

    ```

## **Como Usar a API:**

A API oferece endpoints para gerenciar igrejas, grupos de sorteios, sorteios, prêmios, participantes e ganhadores. Você pode utilizar ferramentas como o Postman ou o Insomnia para testar os endpoints e interagir com a API.

## **Exemplos de Endpoints:**

-   **GET /api/churches:** Retorna a lista de igrejas cadastradas.
-   **POST /api/churches:** Cria uma nova igreja.
-   **GET /api/draw-groups:** Retorna a lista de grupos de sorteios.
-   **POST /api/draw-groups:** Cria um novo grupo de sorteios.
-   **GET /api/draws:** Retorna a lista de sorteios.
-   **POST /api/draws:** Cria um novo sorteio.
-   **GET /api/prizes:** Retorna a lista de prêmios.
-   **POST /api/prizes:** Cria um novo prêmio.
-   **GET /api/participants:** Retorna a lista de participantes.
-   **POST /api/participants:** Cria um novo participante.
-   **GET /api/winners:** Retorna a lista de ganhadores.
-   **POST /api/winners:** Cria um novo ganhador.

**Observações:**

Certifique-se de ter o Composer e o PHP instalados em sua máquina antes de executar os comandos.

Esta API foi desenvolvida como parte de um projeto de demonstração e pode conter recursos limitados em relação a um sistema completo. Sinta-se à vontade para explorar, testar e modificar a API conforme suas necessidades.

**Licença:**

Este projeto é licenciado sob a Licença MIT. Veja o arquivo LICENSE para mais detalhes.
