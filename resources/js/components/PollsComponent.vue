<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h5>Enquetes do dia</h5></div>

                    <div class="card-body">
                        <FormComponent v-on:teste="getPolls"></FormComponent>

                <div class="cards">
                    <div class="row " >
                        <div class="col-sm-6 polls" v-for="poll in polls" :key="poll.id"  v-on:click="click($event)" data-toggle="modal" data-target="#exampleModal">
                            <div class="card-container">
                                <div class="desc">
                                    <h6 class="card-title"> <span>{{poll.description}}</span></h6>
                                </div>
                            <div class="views-p">

                                <button href="#" class="btn btn-primary" style="background-color:#00c3ff" disabled>Visualizações: {{poll.views}}</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
<ModalComponents :opt="opt" :views="views" :name="name" v-on:teste="getPolls"></ModalComponents>

                </div>
            </div>
        </div>

        </div>
    </div>
</template>

<script>
import axios from 'axios'
import $ from 'jquery'
import ModalComponents from './ModalComponents'
import FormComponent from './FormComponent'

    export default {
         data: () => {
              return{
                   teste: '',
                   data:null,
                   polls:[],
                   testes:[],
                   name:"",
                   opt:[],
                   views:0
                }
            },
            components:{
                ModalComponents,
                FormComponent
            },
        mounted() {

            $("#close").on('click', ()=>{
                this.name = '';
                 this.opt = [];
                 this.views='';
                  this.getPolls();
            });

             $("#new").on('click', ()=>{
               $('#new_poll').show()
            });
             $("#hide").on('click', ()=>{
               $('#new_poll').hide();
               var x = document.getElementById('#description');
               console.log(x);
            });

    this.getPolls();
            console.log('Component mounted.')



        },
        methods:{
            click: function(event){

                var targetId = event.currentTarget.id;
                axios.get(`http://localhost:8000/polls/${targetId}`).then((res)=>{
                    var a = res.data;
                    this.name = a.poll_description
                    this.opt = a.options;
                    console.log(res.data);
                    // console.log(this.opt[0].option_description);
                }).then(()=>{
                    axios.get(`http://localhost:8000/poll/status/${targetId}`).then((res)=>{
                        var a = res.data;
                        // console.log(a.views);
                        this.views = a.views;
                    })
                }).then(()=>{
                     var op = document.querySelectorAll(".votes");
                        // console.log(this.opt);
                    for(var i=0; i<this.opt.length; i++){
                        //  console.log();
                        op[i].setAttribute("id", this.opt[i].option_id)
                        // console.log(this.opt[i].option_id);

                    }
                });


            },
            saveVote: function(event){
                var targetId = event.currentTarget.id;
                console.log(targetId)

                axios.post(`http://localhost:8000/api/opt/${targetId}`).then((res)=>{
                    console.log(res)

                }).then(()=>{
                    this.getPolls();

                }).then(()=>{

                    $("#exampleModal").modal('toggle');
                })
            },
            getPolls: function(){
                 axios.get('http://localhost:8000/polls').then((res)=>{
                console.log(res.data);
                this.polls = res.data


                // console.log(this.polls);
                var cont = 0
                // this.polls.forEach(element => {

                //     this.name = element.description;

                //     // axios.get(`http://localhost:8000/polls/${element.id}`).then((res)=>{

                //     //     // console.log(res.data)
                //     //     this.testes[cont] =res.data
                //     //     cont=cont+1;
                //     // });

                // });

            }).then(()=>{
                // console.log(this.testes)
                //  console.log(this.polls.length);
                var pl = document.querySelectorAll(".polls");

                 for(var i=0; i<this.polls.length; i++){
                    //  console.log(pl);
                    pl[i].setAttribute("id", this.polls[i].id)
                    //  console.log(this.polls[i].id);

                 }
            });
            }
        }
    }
</script>
<style scoped>
input{
    border: 1px solid black;
}

/* .polls{
    border: 1px solid red;
    width: 100px;
    height: 100px;
} */
.campanhas{
    display: flex;
    justify-content: space-between;
}
.desc{
    position: relative;
    bottom: 20px;
    /* margin-top: 10px; */
    text-align: center;
    width: 100%;
       /* border: 1px solid red; */
}

.polls {
    padding: 15px;
}
.views-p{
    position: relative;
    bottom: 10px;
    width: 100%;
    /* border: 1px solid red; */
    display: flex;
    justify-content: center;

}

.card-container{
    cursor: pointer;
    height: 140px;
    border: 1px solid #ccc;
    border-radius: 5px;
    display: flex;
    flex-direction: column;
    /* align-items: center; */

    justify-content: flex-end;
}

.card-container h6{
    cursor: pointer;
}

.card-container:hover{
    border: 1px solid  #00c3ff;
}
</style>
