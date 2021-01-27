<template>
   <div>
        <span style="display:none" id="poll_id">{{id}}</span>
        <span>{{description}}</span>
   </div>
</template>

<script>
export default {
    props:{
        id: Number,
        description: String,
        action: Function,
    }
}
</script>

<style>

</style>
