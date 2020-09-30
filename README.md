# ERP Order

---

	- Desenvolvedor : Arthur Batista do Espírito Santo
	- E-mail : arth10@hotmail.com
	- Versão : 1.0.0
	- Compatibilidade : 2.3.4

---

## Descrição

Módulo que enviar dados de pedidos ao ERP

## Instalação

1. Adicione o repositório nas configurações:

```sh
composer config repositories.erp-order vcs git@github.com:arthurbes/erp-order.git
```

2. Instale o módulo:

```sh
composer require arthurbes/erp-order
```

3. Faça o upgrade:

```sh
php bin/magento setup:upgrade
```

4. Faça a compilação:

```sh
php bin/magento setup:di:compile
```
