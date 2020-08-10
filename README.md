# app.futured.register

**build docker app container with Makefile**

```
git clone https://github.com/p-mion/app.futured.register.git
cd app.futured.register
make
make start
>sh console.sh summary
>sh console.sh add 56.50
>sh console.sh list
```

`make` - build php/mysql containers

`make start` - start app/db containers

`make stop` - start app/db containers

**console script**

`sh ./console.sh` 

```
Register [command]
Command:
  summary - summary of current register's bills
  list - list all current register's bills
  get <bill_id> - selected bill properties
  add <price> [amount] - add payment
  cancel <bill_id> - cancel payment
```

**app url**

http://localhost:8001/

