{{-- 返信のいいね機能 --}}
<div class="d-flex align-items-center" id="app">
  <button type="submit" class="btn p-0 border-0 text-primary" @click="addHeart"><i
      class="far fa-heart fa-fw"></i></button>

  {{-- <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button> --}}

  <span>@{{ count }}</span>
</div>

<script>
  var app = new Vue({
el:'#app',
data:{
  count:0,
},
methods:{
  addHeart(){
    if(this.count === 0 ) {
      this.count++;
  }else{
    this.count--;
  }
 }
}
});
</script>