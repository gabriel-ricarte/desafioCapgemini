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
                 <li> ENDPOINT : http://localhost:8000/api/user/list </li>
                 <li> REPOSTA : [message: [] , data : []] </li>
            </ul>
            <p>CRIAR</p>
            <ul>
                <li> METODO : POST </li>
                 <li> ENDPOINT : http://localhost:8000/api/user/create </li>
                 <li>
                     EXEMPLO: 
                      {
                         "nome": "BELTRANO PEREIRA", 
                         "data_nasc": "2000-01-01",
                         "sexo": "M",
                         "cpf":  "98733159009",
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
                <li> METODO : GET </li>
                 <li> ENDPOINT : http://localhost:8000/api/movimentacao/saldo</li>
                 <li>
                     EXEMPLO: 
                      {
                         "user_id": "1", 
                         "senha": "1234"
                     }
                    </li>                    
                 <li> REPOSTA : [message: [] , data : []] </li>
            </ul>
   <p>SAQUE</p>
            <ul>
                <li> METODO : POST </li>
                 <li> ENDPOINT : http://localhost:8000/api/movimentacao/saque</li>
                 <li>
                     EXEMPLO: 
                      {
                         "user_id": "1", 
                         "senha": "1234",
                         "valor" : 10000
                     }
                    </li>                    
                 <li> REPOSTA : [message: [] , data : []] </li>
            </ul>
   <p>DEPOSITO</p>
            <ul>
                <li> METODO : POST </li>
                 <li> ENDPOINT : http://localhost:8000/api/movimentacao/deposito</li>
                 <li>
                     EXEMPLO: 
                      {
                         "user_id": "1", 
                         "senha": "1234",
                         "valor" : 100000
                     }
                    </li>                    
                 <li> REPOSTA : [message: [] , data : []] </li>
            </ul>
    <p>EXTRTATO</p>
            <ul>
                <li> METODO : POST </li>
                 <li> ENDPOINT : http://localhost:8000/api/movimentacao/extrato</li>                                 
                 <li> REPOSTA : [message: [] , data : []] </li>
            </ul>
       
        
  ## tipos movimentação
  <p>LISTA</p>
            <ul>
                <li> METODO : GET </li>
                 <li> ENDPOINT : http://localhost:8000/api/tipo-movimentacao/list </li>
                 <li> REPOSTA : [message: [] , data : []] </li>
            </ul>  
     

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## frontEnd 
 - está na pasta frontEndVue

