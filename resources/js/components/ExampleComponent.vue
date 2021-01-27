<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">

                     <input type="text" v-model="teste" >
                     {{teste}}

                    <span>hello</span>
                    </div>
                <div class="campanhas">
                    <div v-for="poll in teste" :key="poll.id" class="polls">
                        <span>{{poll}}</span>

                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import PollComponents from './PollComponents'

    export default {
         data: () => {
              return{
                   teste: '',
                   data:null,
                   polls:[],
                   testes:[],
                   name:[]
                }
            },
            components:{
                PollComponents
            },
        mounted() {
            axios.get('http://localhost:8000/polls').then((res)=>{
                // console.log(res.data);
                this.polls = res.data

                console.log(this.polls);
                var cont = 0
                this.polls.forEach(element => {
                    console.log(element.id);
                    this.name = element.description;
                    axios.get(`http://localhost:8000/polls/${element.id}`).then((res)=>{

                        // console.log(res.data)
                        this.testes[cont] =res.data
                        cont=cont+1;
                    });

                });

            }).then(()=>{
                console.log(this.testes)
            });
            console.log('Component mounted.')

        }
    }
</script>
<style scoped>
input{
    border: 1px solid black;
}

.polls{
    border: 1px solid red;
    width: 100px;
    height: 100px;
}
.campanhas{
    display: flex;
    justify-content: space-between;
}
</style>
