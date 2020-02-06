<template>
  <div id="app">
    <!-- <div class="d-flex align-items-center"> -->
    <button v-if="!Heart" type="submit" class="btn p-0 border-0 text-primary" @click="addLike">
      <i class="far fa-heart fa-fw"></i>
      {{ count }}
    </button>
    <button v-else type="submit" class="btn p-0 border-0 text-danger">
      <i class="fas fa-heart fa-fw" @click="addLike"></i>
      {{ count }}
    </button>
    <span></span>
    <!-- </div> -->
  </div>
</template>
<script>
export default {
  data() {
    return {
      Heart: true,
      count: 0
    };
  },
  methods: {
    addLike() {
      // document.addEventListener("DOMContentLoaded", function(event) {
      // 元々記述のあった処理をaddEventListenerのカッコで挟む
      if (this.count === 0) {
        this.count++;
        this.Heart = false;
      } else {
        this.count--;
        this.Heart = true;
      }
      // });
    }
  }
};
</script>