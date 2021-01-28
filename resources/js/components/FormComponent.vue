<template>
  <div class="new-poll">
        <div>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fomrModal" data-whatever="@mdo">Nova Enquete</button>
        </div>

        <div class="modal fade" id="fomrModal" tabindex="-1" role="dialog" aria-labelledby="fomrModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Nova Enquete</h5>
                        <button type="button" v-on:click="closePoll()" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span style="color:red">{{erro}}</span>
                        <form>
                            <div class="form-group">
                                <label for="description" class="col-form-label">Insira uma descição</label>
                                <input type="text"  class="form-control" name="" id="description" maxlength="100">
                            </div>
                            <div class="form-group">
                                <label for="opt_1" class="col-form-label">Insira uma opção</label>
                                <input type="text"  class="form-control" name="" id="opt_1">
                            </div>
                                <div class="form-group">
                                <label for="opt_2" class="col-form-label">Insira uma opção</label>
                                <input type="text"  class="form-control" name="" id="opt_2">
                            </div>
                                <div class="form-group">
                                <label for="opt_3" class="col-form-label">Insira uma opção</label>
                                <input type="text"  class="form-control" name="" id="opt_3">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="button" v-on:click="save()"  class="btn btn-primary">Salvar Enquete</button>
                    </div>
                </div>
            </div>
        </div>
  </div>



</template>

<script>
export default {
    data(){
        return{
            erro:null
        }
    },
    methods:{
        closePoll: function(){
            document.getElementById('description').value = "";
            document.getElementById('opt_1').value ="";
            document.getElementById('opt_2').value ="";
            document.getElementById('opt_3').value="";
        },
        save: function(){
            var desc = document.getElementById('description').value;
            var opt1 = document.getElementById('opt_1').value;
            var opt2 = document.getElementById('opt_2').value;
            var opt3 = document.getElementById('opt_3').value;

            if(desc != "" && opt1 != "" && opt2 != "" && opt3 != ""){
                    console.log(desc)
                    console.log(opt1)
                    console.log(opt2)
                    console.log(opt3)

                        var x = {
                        "description": desc,
                        "option":[
                            {"nome" : opt1},
                            {"nome" : opt2},
                            {"nome" : opt3}
                        ]
                    }

                    axios.post("http://localhost:8000/api/poll", x)
                    .then((res)=>{
                        console.log(res);

                    }).then(()=>{
                        this.$emit('teste');
                        this.closePoll();
                        var x = document.getElementById("fomrModal");
                        $("#fomrModal").modal('toggle')
                        console.log(x);
                    });
            }else{
                this.erro = "Complete todas as informações";
                setTimeout(()=>{
                    this.erro = "";
                },2000);
            }

        }
    }
}
</script>

<style>
.new-poll{
    width: 100%;
    height: 100%;
    /* border: 1px solid red; */
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}
small{
    margin-left: 10px;
     font-weight: 600;
}

span{
        font-weight: 600;
    font-size: 17px;
}

</style>
