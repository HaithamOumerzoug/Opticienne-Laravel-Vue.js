/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: Axios } = require('axios');

require('./bootstrap'); 
import Vue from 'vue';
//import VeeValidate from 'vee-validate';

//Vue.use(VeeValidate);

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('add-commande', require('./components/AddCommandeComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

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
                Axios.post('http://127.0.0.1:8000/commandes',this.commandes[i])
                .then(response => {
                    if(response.data.etat && x==this.commandes.length){
                        document.location.href="http://127.0.0.1:8000/commandes"
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
                Axios.post('http://127.0.0.1:8000/stocks',this.stocks[i])
                .then(response => {
                    if(response.data.etat && c==this.stocks.length){
                        document.location.href="http://127.0.0.1:8000/stocks"
                    }
                    
                })
                .catch(error => {console.error('errors: ',error);})
            }
        },
        getprice(){
            
                this.commandes.forEach(commande => {
                    if(commande.article !="" && commande.Qte_cmd>0){
                        Axios.get('http://127.0.0.1:8000/getprice/'+commande.article+'/'+commande.Qte_cmd)
                        .then(response => {
                            commande.price=response.data;
                            
                        })
                        .catch(error => {console.error('errors: ',error);})
                        }else if(commande.article ==""|| commande.Qte_cmd<=0)commande.price=0;
                });
            
           
        },
        getcommandes(){
            if(this.allCommandes.length<1 ){
                Axios.get('http://127.0.0.1:8000/getcommandes')
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
            Axios.get('http://127.0.0.1:8000/getcommandes')
                .then(response => {
                    this.c=response.data.length;
                }).catch(error => {console.error('errors: ',error);})
        }
    },
    mounted:function(){
        this.getnumbercommande();
    },
    
});
