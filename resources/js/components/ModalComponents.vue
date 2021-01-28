<template>
    <div class="modal fade" id="optionsModal" tabindex="-1" role="dialog" aria-labelledby="optionsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="height: 420px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="optionsModalLabel">{{name}}</h5>
                    <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="cont">
                    <div class="modal-body optM" v-for="o in opt" :key="o.id" >
                    <div class="tittle">
                        <span>{{o.option_description}}</span>
                    </div>
                    <div class="opt-votes">
                       <!-- <button class="votes" v-on:click="saveVote($event)">votar</button> -->
                       <button type="button" class="btn btn-success votes" v-on:click="saveVote($event)">Votar</button><span>votos: {{o.votes}}</span>
                    </div>
                </div>
                </div>

                </div>
            </div>
    </div>
</template>

<script>
export default {
    props:{
        name: String,
        opt:Array,

    },
    methods:{
         saveVote: function(event){
            var targetId = event.currentTarget.id;
            console.log(targetId)

            axios.post(`http://localhost:8000/api/opt/${targetId}`).then((res)=>{
                console.log(res)

            }).then(()=>{
                this.$emit('teste');

            }).then(()=>{

                $("#optionsModal").modal('toggle');
            })
        },
    }
}
</script>

<style>
.opt-votes{
    /* border: 1px solid red; */
    margin-top: 10px;
    padding: 5px;
    display: flex;
    justify-content: space-between;
}
.optM{
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
    width: 80%;
    margin-top: 10px;
}
.optM:hover{
      border: 1px solid #00cc8d;
}
.cont{
    display: flex;
   flex-direction: column;
   align-items: center;
}
</style>
