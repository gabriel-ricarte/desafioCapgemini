<template>
  <section class="our-webcoderskull padding-lg" v-model="conta">
            <div class="container">
                <div class="row heading heading-icon">
                    <h2>Operações disponíveis</h2>
                </div>
                <ul class="row" >
                    <li class="col-12 col-md-6 col-lg-3">
                        <div class="cnt-block equal-hight" style="height: 349px;">
                            <figure><img src="https://cdn.icon-icons.com/icons2/2248/PNG/512/cash_minus_icon_138796.png" class="img-responsive" alt=""></figure>
                            <h2><a href="#" v-on:click="saque()" >SAQUE</a></h2>
                        </div>
                    </li>
                    <li class="col-12 col-md-6 col-lg-3">
                        <div class="cnt-block equal-hight" style="height: 349px;">
                            <figure><img src="https://webstockreview.net/images/dollar-clipart-show-me-the-money-13.png" class="img-responsive" alt=""></figure>
                            <h2><a href="#" v-on:click="saldo()">SALDO</a></h2>
                        </div>
                    </li>
                    <li class="col-12 col-md-6 col-lg-3">
                        <div class="cnt-block equal-hight" style="height: 349px;">
                            <figure><img src="https://cdn.icon-icons.com/icons2/2248/PNG/512/cash_plus_icon_138795.png" class="img-responsive" alt=""></figure>
                            <h2><a href="#" v-on:click="deposito()">DEPOSITO</a></h2>
                        </div>
                    </li>
                </ul>
            </div>
   </section>
</template>
<style>
.row.heading h2 {
    color: #fff;
    font-size: 52.52px;
    line-height: 95px;
    font-weight: 400;
    text-align: center;
    margin: 0 0 40px;
    padding-bottom: 20px;
    text-transform: uppercase;
}
ul{
  margin:0;
  padding:0;
  list-style:none;
}
.heading.heading-icon {
    display: block;
}
.padding-lg {
	display: block;
	padding-top: 60px;
	padding-bottom: 60px;
}
.practice-area.padding-lg {
    padding-bottom: 55px;
    padding-top: 55px;
}
.practice-area .inner{
     border:1px solid #999999;
	 text-align:center;
	 margin-bottom:28px;
	 padding:40px 25px;
}
.our-webcoderskull .cnt-block:hover {
    box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
    border: 0;
}
.practice-area .inner h3{
    color:#3c3c3c;
	font-size:24px;
	font-weight:500;
	font-family: 'Poppins', sans-serif;
	padding: 10px 0;
}
.practice-area .inner p{
    font-size:14px;
	line-height:22px;
	font-weight:400;
}
.practice-area .inner img{
	display:inline-block;
}


.our-webcoderskull{
  background: url("http://www.webcoderskull.com/img/right-sider-banner.png") no-repeat center top / cover;

}
.our-webcoderskull .cnt-block{
   float:left;
   width:100%;
   background:#fff;
   padding:30px 20px;
   text-align:center;
   border:2px solid #d5d5d5;
   margin: 0 0 28px;
}
.our-webcoderskull .cnt-block figure{
   width:148px;
   height:148px;
   border-radius:100%;
   display:inline-block;
   margin-bottom: 15px;
}
.our-webcoderskull .cnt-block img{
   width:148px;
   height:148px;
   border-radius:100%;
}
.our-webcoderskull .cnt-block h3{
   color:#2a2a2a;
   font-size:20px;
   font-weight:500;
   padding:6px 0;
   text-transform:uppercase;
}
.our-webcoderskull .cnt-block h3 a{
  text-decoration:none;
	color:#2a2a2a;
}
.our-webcoderskull .cnt-block h3 a:hover{
	color:#337ab7;
}
.our-webcoderskull .cnt-block p{
   color:#2a2a2a;
   font-size:13px;
   line-height:20px;
   font-weight:400;
}
.our-webcoderskull .cnt-block .follow-us{
	margin:20px 0 0;
}
.our-webcoderskull .cnt-block .follow-us li{
    display:inline-block;
	width:auto;
	margin:0 5px;
}
.our-webcoderskull .cnt-block .follow-us li .fa{
   font-size:24px;
   color:#767676;
}
.our-webcoderskull .cnt-block .follow-us li .fa:hover{
   color:#025a8e;
}
</style>
<script>
    export default {
        data () {
            return {
            data:[],
            errors:[]
            }
        },
        props:['conta','senha'],

        methods : {
            saldo(){
                axios.get('http://localhost:8000/api/movimentacao/saldo?conta='+this.conta+'&senha='+this.senha)
                .then(response => {
                 this.data.push(response.data);
                 this.errors.push(response.data.message);
                 bootbox.alert("Saldo é de  : R$ "+ (response.data.data/100));
                })
                .catch(e => {
                this.errors.push(e.data.message);
                })
                console.log(this.errors);
                console.log(this.data);
            },
            saque(){
                const contaValue = this.conta;
                const senhaValue = this.senha;
                bootbox.prompt("Quanto deseja sacar ?", function(result){
                    axios.post('http://localhost:8000/api/movimentacao/saque',{
                    "conta": contaValue,
                    "senha": senhaValue,
                    "valor": result*100
                    }
                    )
                    .then(response => {
                    this.data.push(response.data);
                    this.errors.push(response.data.message);
                    bootbox.alert("Operação realizada com sucesso!");
                    })
                    .catch(e => {
                    this.errors.push(e.data.message);
                    })
                })
            },
            deposito(){
                 const contaValue = this.conta;
                    const senhaValue = this.senha;
                    bootbox.prompt("Quanto deseja depositar ?", function(result){
                    axios.post('http://localhost:8000/api/movimentacao/deposito',{
                    "conta": contaValue,
                    "senha": senhaValue,
                    "valor": result*100
                    }
                    )
                    .then(response => {
                    this.data.push(response.data);
                    this.errors.push(response.data.message);
                    bootbox.alert("Operação realizada com sucesso!");
                    })
                    .catch(e => {
                    this.errors.push(e.data.message);
                    })
                })
            }
        }


    }
</script>
