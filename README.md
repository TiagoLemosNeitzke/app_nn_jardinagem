# App NN Jardinagem

Com este projeto pretendo facilitar a gestão de clientes, serviços, recebimentos, despesas e contas à pagar, ara prestadores de serviço de jardinagem. Uma das maiores dificuldades que sempre encontrei durante meus anos com prestador de serviço foi encontrar um aplicativo que facilitasse a gestão de forma simples, sem que houvesse um monte de funções.
Meu objetivo é criar algo simples que qualquer pessoa que tenha acesso a internet consiga usar.

## 🚀 Começando

Para colaborar com este projeto você precisa clonar este repositório para seu ambiente local

```
git clone https://github.com/TiagoLemosNeitzke/app_nn_jardinagem.git
```

### 📋 Pré-requisitos

Para rodar este projeto você precisa ter instalado em sua máquina docker.
Veja com instalar docker na doc do [Docker](https://docs.docker.com/get-docker/)

### 🔧 Colaborando com o projeto

Após clonar o repositório instale a pasta vendor no seu projeto, já que ela não é versionada.

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

Após fazer a instalação da vendor rode no terminal do projeto

```
./vendor/bin/sail up -d
```

Seu projeto deverá ser criado no docker. Após rodar o projeto no docker rode as migrations

```
./vendor/bin/sail art migrate
```

Agora você já deve estar pronto para contribuir com este projeto.

## 📌 Versão

Nós usamos [git](https://git-scm.com/) para controle de versão. Para as versões disponíveis, observe as [tags neste repositório](https://github.com/TiagoLemosNeitzke/app_nn_jardinagem).

## ✒️ Autores

Este projeto está sendo desenvolvido por:

* **Tiago Lemos Neitzke** - *Trabalho Inicial/ Documentação* - [Github](https://github.com/TiagoLemosNeitzke) - [Linkedin](https://www.linkedin.com/in/tiago-lemos-neitzke/)

## 📄 Licença

Este projeto está sob a licença (MIT).
