const { default: Axios } = require('axios');

require('./bootstrap'); 
import Vue from 'vue';


window.Vue = require('vue');


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('add-commande', require('./components/AddCommandeComponent.vue').default);

//const url="http://127.0.0.1:8000"
const url=`${window.location.protocol}//${window.location.host}`
const app = new Vue({
    el: '#app',
    data:{
        c:0,
        commandes:
        [
            {
                patient:'',
                datecmd:'',
                article : '',
                Qte_cmd : 1,
                price : '0'
            }
        ],
        stocks:[
            {
                article : '',
                Qte_stk : 1
            }
        ],
        allCommandes:
        [
            
        ]
        
    },
    methods:{
        addnewcomande(){
            this.commandes.push(
                {
                    patient:'',
                    datecmd:'',
                    article : '',
                    Qte_cmd : 1,
                    price: 0
                }
            )
        },
        addnewstock(){
            this.stocks.push(
                {
                    article : '',
                    Qte_stk : 1
                }
            )
        },
        affichenewcommande(){
            this.allCommandes.push(
                {
                    id:'',
                    patient:'',
                    article :'',
                    Qte:'',
                    price:'',
                    datecmd:'',
                }
            )
        },
        hideallcommandes(){
            this.allCommandes.splice(0,this.c);
        },
        deletecommandeform(index){
            if(this.commandes.length>1 ){
            this.commandes.splice(index,1);}
        },
        deletestockform(index){
            if(this.stocks.length>1 ){
            this.stocks.splice(index,1);}
        },
       
        storeCommandes(){ 
            var x=0;
            for(var i=0;i<this.commandes.length;i++){
                x++;
                Axios.post(`${url}/commandes`,this.commandes[i])
                .then(response => {
                    if(response.data.etat && x==this.commandes.length){
                        document.location.href=`${url}/commandes`
                    }
                    else{
                        alert("Qte out of stock!!");
                    }
                    
                })
                .catch(error => {console.error('errors: ',error);})
            }
        },
        storeStocks(){
            var c=0;
            for(var i=0;i<this.stocks.length;i++){
                c++;
                Axios.post(`${url}/stocks`,this.stocks[i])
                .then(response => {
                    if(response.data.etat && c==this.stocks.length){
                        document.location.href=`${url}/stocks`
                    }
                    
                })
                .catch(error => {console.error('errors: ',error);})
            }
        },
        getprice(){
            
                this.commandes.forEach(commande => {
                    if(commande.article !="" && commande.Qte_cmd>0){
                        Axios.get(`${url}/getprice/${commande.article}/${commande.Qte_cmd}`)
                        .then(response => {
                            commande.price=response.data;
                            
                        })
                        .catch(error => {console.error('errors: ',error);})
                        }else if(commande.article ==""|| commande.Qte_cmd<=0)commande.price=0;
                });
            
           
        },
        getcommandes(){
            if(this.allCommandes.length<1 ){
                Axios.get(`${url}/getcommandes`)
                .then(response => {
                    for(var i=0;i<this.c;i++)this.affichenewcommande();

                    for(var i=0;i<this.c;i++){
                        this.allCommandes[i].id=response.data[i].id;
                        this.allCommandes[i].article=response.data[i].article;
                        this.allCommandes[i].patient=response.data[i].patient;
                        this.allCommandes[i].price=response.data[i].Prix_de_vente;
                        this.allCommandes[i].Qte=response.data[i].Qte;
                        this.allCommandes[i].datecmd=response.data[i].date_cmd;
                    }
                            })
                        .catch(error => {console.error('errors: ',error);})
            }else{
                this.hideallcommandes();
            }
            
        },
        getnumbercommande(){
            Axios.get(`${url}/getcommandes`)
                .then(response => {
                    this.c=response.data.length;
                }).catch(error => {console.error('errors: ',error);})
        }
    },
    mounted:function(){
        this.getnumbercommande();
    },
    
});
