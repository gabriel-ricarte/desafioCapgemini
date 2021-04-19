<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Antes de rodar 
 - composer update
 - configurar arquivo .env com o nome do banco  : desafioCapgemini
 - criar o banco 
 - php artisan migrate
 - php artisan serve : apontando para o localhost:8000

## Sobre a API 

API para operações financeiras com consulta de saldo e extrato, possibilidade de saque e deposito.

## Endpoints usuarios

			<p>LISTA</p>
            <ul>
                <li> METODO : GET </li>
                 <li> ENDPOINT : http://localhost:8000/user/list </li>
                 <li> REPOSTA : [message: [] , data : []] </li>
            </ul>
            <p>CRIAR</p>
            <ul>
                <li> METODO : POST </li>
                 <li> ENDPOINT : http://localhost:8000/user/create </li>
                 <li>
                     EXEMPLO: 
                      {
                         "nome": "BELTRANO PEREIRA", 
                         "data_nasc": "2000-01-01",
                         "sexo": "M",
                         "cpf":  "98733159009\",
                         "tipo_pessoa": "F"
                     }
                    </li>                    
                 <li> REPOSTA : [message: [] , data : []] </li>
            </ul>
		
  
  ## Endpoint conta corrente
            <p>LISTA</p>
            <ul>
                <li> METODO : GET </li>
                 <li> ENDPOINT : http://localhost:8000/api/conta-corrente/list </li>
                 <li> REPOSTA : [message: [] , data : []] </li>
            </ul>
            <p>CRIAR</p>
            <ul>
                <li> METODO : POST </li>
                 <li> ENDPOINT : http://localhost:8000/api/conta-corrente/create</li>
                 <li>
                     EXEMPLO: 
                      {
                         "user_id": "1", 
                         "senha": "1234"
                     }
                    </li>                    
                 <li> REPOSTA : [message: [] , data : []] </li>
            </ul>
            <p>MOSTRA</p>
            <ul>
                 <li> METODO : GET </li>
                 <li> ENDPOINT : http://localhost:8000/api/conta-corrente/show/1</li>                  
                 <li> REPOSTA : [message: [] , data : []] </li>
            </ul>
			
 ## Endpoint movimentacao 
         <p>SALDO</p>
            <ul>
                <li> METODO : POST </li>
                 <li> ENDPOINT : http://localhost:8000/movimentacao/saldo</li>
                 <li>
                     EXEMPLO: 
                      {
                         "user_id": "1", 
                         "senha": "1234"
                     }
                    </li>                    
                 <li> REPOSTA : [message: [] , data : []] </li>
            </ul>
        <p>SALDO</p>
            <ul>
                <li> METODO : POST </li>
                 <li> ENDPOINT : http://localhost:8000/movimentacao/saldo</li>
                 <li>
                     EXEMPLO: 
                      {
                         "user_id": "1", 
                         "senha": "1234"
                     }
                    </li>                    
                 <li> REPOSTA : [message: [] , data : []] </li>
            </ul>
        {
			"name": "SALDO",
			"protocolProfileBehavior": {
				"disableBodyPruning": true,
				"strictSSL": true
			},
			"request": {
				"auth": {
					"type": "apikey",
					"apikey": [
						{
							"key": "value",
							"value": "ZTliMWNmYzdmNDM5NzhjYjE4ZTc5OTgyN2M5MmNiMzA=MjEzZWFjN2QtYjE5MC00ZDI5LTk3YzItZmVkNzFkNTc4ZWUwOTdiZThjZjJjNmE4ZTA0N2MzZjczOTEyY2I4MzJjNmI=ZGE2NTE3MDgtZDljOC00OWQyLThkY2UtYzVmZTE5NDE0NGFi",
							"type": "string"
						},
						{
							"key": "key",
							"value": "Authorization",
							"type": "string"
						},
						{
							"key": "in",
							"value": "header",
							"type": "string"
						}
					]
				},
				"method": "GET",
				"header": [],
				"body": {
					"mode": "raw",
					"raw": "{ \n\"conta\": \"0001\", \n\"senha\": \"1234\"\n}",
					"options": {
						"raw": {
							"language": "json"
						}
					}
				},
				"url": {
					"raw": "http://localhost:8000/movimentacao/saldo",
					"protocol": "http",
					"host": [
						"localhost"
					],
					"port": "8000",
					"path": [
						"movimentacao",
						"saldo"
					]
				}
			},
			"response": []
		},
		{
			"name": "SAQUE",
			"request": {
				"method": "POST",
				"header": [],
				"body": {
					"mode": "raw",
					"raw": "{ \r\n\"conta\": \"0001\", \r\n\"senha\": \"1234\",\r\n\"valor\": 10000\r\n}   ",
					"options": {
						"raw": {
							"language": "json"
						}
					}
				},
				"url": {
					"raw": "http://localhost:8000/api/movimentacao/saque",
					"protocol": "http",
					"host": [
						"localhost"
					],
					"port": "8000",
					"path": [
						"api",
						"movimentacao",
						"saque"
					]
				}
			},
			"response": []
		},
		{
			"name": "DEPOSITO",
			"request": {
				"method": "POST",
				"header": [],
				"body": {
					"mode": "raw",
					"raw": "{ \r\n\"conta\": \"0001\", \r\n\"senha\": \"1234\",\r\n\"valor\": 10000\r\n}   ",
					"options": {
						"raw": {
							"language": "json"
						}
					}
				},
				"url": {
					"raw": "http://localhost:8000/api/movimentacao/deposito",
					"protocol": "http",
					"host": [
						"localhost"
					],
					"port": "8000",
					"path": [
						"api",
						"movimentacao",
						"deposito"
					]
				}
			},
			"response": []
		},
		{
			"name": "EXTRATO",
			"request": {
				"method": "POST",
				"header": [],
				"body": {
					"mode": "raw",
					"raw": "{ \r\n\"conta\": \"0001\", \r\n\"senha\": \"1234\",\r\n\"periodo\":\"A\",\r\n\"valor_periodo\":2021\r\n}",
					"options": {
						"raw": {
							"language": "json"
						}
					}
				},
				"url": {
					"raw": "http://localhost:8000/api/movimentacao/extrato",
					"protocol": "http",
					"host": [
						"localhost"
					],
					"port": "8000",
					"path": [
						"api",
						"movimentacao",
						"extrato"
					]
				}
			},
			"response": []
		}
        
      ## tipos movimentação
      
      {
			"name": "LISTA",
			"protocolProfileBehavior": {
				"disableBodyPruning": true
			},
			"request": {
				"method": "GET",
				"header": [],
				"body": {
					"mode": "raw",
					"raw": "",
					"options": {
						"raw": {
							"language": "json"
						}
					}
				},
				"url": {
					"raw": "http://localhost:8000/api/tipo-movimentacao/list",
					"protocol": "http",
					"host": [
						"localhost"
					],
					"port": "8000",
					"path": [
						"api",
						"tipo-movimentacao",
						"list"
					]
				}
			},
			"response": []
		}
        

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
