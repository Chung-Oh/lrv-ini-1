# Validações e Formulários
CRUD simples com Route resources, Blade, Migrations, Factory e Seeder.

Para trabalhar com validação de CPF e CNPJ baixar biblioteca code_validater da Code Education.

composer require codeedu/code_validator:0.0.2

1) Em \App\Providers\AppServiceProvider.php no método boot() registrar a validação
2) Ir ao arquivo onde está a regra de validação, nesse projeto foi realizado em \App\Http\Controllers\Admin\ClientsController.php
3) Mensagens de erros \Resources\lang\validation.php
