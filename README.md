## URL Shortened

### Project Requirements
* PHP (^8)
* [Composer](https://getcomposer.org/)
* Node (v17.6.0)
* NPM (8.5.1)
* MySQL Server
* Ngrok (if you want to dynamic url)

### Project setup
* Clone the repository [Repo](https://github.com/mkawsar/shortened-url)
* Make sure `PHP`, `Composer`, `Node` and `NPM` is installed in the system
* If you want to dynamic valid url then please make sure `Ngrok` is installed in the system
* Run `composer install` and `npm install` to install the dependencies
* Make a copy for local environment and setup all configurations
  ```bash
    cp .env.example .env
   ```
  ```bash
    php artisan key:generate
  ```
* Run the following command for migration
  ```bash
    php artisan migrate
  ```

### Run the solution
* First run the backend server using this command
    ```bash
      php artisan serve
    ```
* Run the following command for create bundle file
  ```bash
    npm run dev
  ```
* If you want to build with dynamic valid url then please run the following command
    ```bash
      ngrok http 8000
    ```

### Support

If you have any questions or confusion please email me at **mkawsarahmed@outlook.com** or open an issue in the repository.
