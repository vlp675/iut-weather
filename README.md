# IUT Laravel
This repository is a starter giving you all tools you need to help you build your application with [Laravel](https://laravel.com) and PHP.

> Since this repository is for learning purpose, it is **not production ready**

## Requirements
- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- [Visual Studio Code](https://code.visualstudio.com/download) with the [Docker](https://marketplace.visualstudio.com/items?itemName=ms-azuretools.vscode-docker) and the [DevContainers](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers) extensions
- Git

### Windows Requirements
- [WSL 2](https://learn.microsoft.com/fr-fr/windows/wsl/install)
- Ubuntu 24.04 installed from the [Microsoft Store](https://apps.microsoft.com/detail/9nz3klhxdjp5?hl=fr-fr&gl=FR)
- [WSL](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-wsl) extension for Visual Studio Code
- [Optional] [Windows Terminal](https://apps.microsoft.com/detail/9n0dx20hk701?hl=fr-FR&gl=FR)

## Init project
### Create a GitHub repository
Create a project named iut-weather in your own GitHub and follow the repository instructions.

> On Windows, make sure to clone this repository in the WSL 2 Ubuntu 24.04 distro.

### Files and directory
From this repository (donovanbroquin/iut-laravel), take the following files and put them on your own repository:

- .devcontainer
- .gitignore
- compose.yml
- dockerfile
- dockerfile.production

After that, create a *laravel* directory at project **root**

### Create the environment
You have two ways to create the environment:
- Dev Containers: easier but require the [Microsoft Dev Containers](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers) extension
- Docker Compose: common but need to play with differentes terminals and export some data on Windows / Linux

> If you cannot install the Dev Containers extension, you have to use the Docker Compose way.

#### Windows / Linux specifities
Since you have to use WSL 2 with Ubuntu for this projet, you need to export the user and group ids for your Ubuntu user.
Simply launch this in the WSL 2 terminal:

```shell
export USER_ID=$(id -u)
export GROUP_ID=$(id -g)
```

#### Dev Containers
Open the project with VSCode and a notification should appear to ask you if you want to re-open in a container. 
Say yes and you should have a new window with an empty explorer.

If there is no notification, you can launch it using the command palette and selecting `> Dev Containers: Rebuild and Reopen in Container`.

> Using this way, your VSCode is directly in the laravel directory of your project

#### Docker Compose
You can now start the environment from your own repository using Docker Compose with the following command line from the project root

```shell
docker compose up -d
```

> This command line **MUST** be launched from your host using the Visual Studio Code **integrated terminal**

> **Windows users**: open the project using the WSL extension @todo > make video

Once the command has been launched, you should see something similar in your terminal.

![Visual Studio Code Terminal with running Docker Compose stack](https://github.com/dbroquin/iut-laravel/blob/3b34647736b46b267ab39823bb5608e8f5d23073/screenshots/docker-compose-launched.png?raw=true)

Finally, you can access the container terminal using the Visual Studio command palette and selecting

```shell
> Docker Containers: Attach Shell > iut-laravel > iut:latest
```

### Create the project root
Your Laravel app code **must** be in the `laravel` directory which is the default place for a terminal within the container. 
Use the following command lines to initiate it.

```shell
composer create-project laravel/laravel .
```

This command will create all files and install dependencies using [Composer](https://getcomposer.org/doc/00-intro.md)

Now, you have to update two files

```env
# .env

APP_URL=http://127.0.0.1
```

```javascript
# vite.config.js

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
    }
});
```

Once it’s done, the app should be available at [127.0.0.1](http://127.0.0.1)

![Laravel default screen](https://github.com/dbroquin/iut-laravel/blob/3b34647736b46b267ab39823bb5608e8f5d23073/screenshots/laravel-ready.png?raw=true)

Congratulations 🎉 You can now start build your app!

## Services
In Docker Desktop, you can see three containers in the iut-laravel stack.
- laravel: this is where you application live
- nginx: the webserver, like Apache
- mailpit: will be used later too for email development and can be seen at [127.0.0.1:8025](http://127.0.0.1:8025)

## Terminals
To keep peace in your mind, you need to remember there is many terminals to use and each one has a specific purpose.

- system: use it to interact with Git, mount containers. For Windows user, this terminal is the one running in the Ubuntu 24.04 distro
- container: use it to interact with the app and PHP. Ex: `php artisan`, `composer`, ... This one is launched using the VSCode Docker plugin

### Open the container terminal
VSCode with the Docker plugin make it easy to open a terminal within a container by using the command palette and using the `> Docker Containers: Attach Shell` shortcut

To open the command palette, you can use the following keyboard shortcuts
- macOS: **CMD+SHIFT+P**
- Windows: **FN+F1**

![Visual Studio Code open container terminal](https://github.com/dbroquin/iut-laravel/blob/624b5e34d1e5cc41b9e5f9c7262f9247e28c5e92/screenshots/vscode-open-container-terminal.mov?raw=true)

### Which terminal?
In VSCode, those terminals can be differentiated by their name and icons.
In the following screenshot, the system terminal is the `zsh` one in the right column and the container one, the `Shell: laravel task`.

![Visual Studio Code terminals.](https://github.com/dbroquin/iut-laravel/blob/624b5e34d1e5cc41b9e5f9c7262f9247e28c5e92/screenshots/vscode-terminals.png?raw=true)

> The system terminal name can be different for you according to your environment. Keep in mind the Docker container one will have Shell prefix and a spinner at end
























export USER_ID=$(id -u) && export GROUP_ID=$(id -g)