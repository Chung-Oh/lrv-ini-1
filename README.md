# Validations and Forms

Simple CRUD with Route resources, Blade, Migrations, Factory and Seeder.

To work with CPF and CNPJ validation download code_validater library from Code Education.

composer require codeedu / code_validator: 0.0.2

1) In\App\Providers\AppServiceProvider.php in the boot() method register validation
2) Go to the file where the validation rule is, this project was done in \App\Http\Controllers\Admin\ClientsController.php
3) Error Messages are in \Resources\lang\validation.php
