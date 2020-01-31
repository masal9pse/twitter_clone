<template>
  <div id="app">
    <div class="d-flex align-items-center">
      <button type="submit" class="btn p-0 border-0 text-primary" @click="addLike">
        <i class="far fa-heart fa-fw"></i>
      </button>

      <!-- <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>  -->

      <span>{{ count }}</span>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      count: 0
    };
  },
  methods: {
    addLike() {
      // 元々記述のあった処理をaddEventListenerのカッコで挟む
      if (this.count === 0) {
        this.count++;
      } else {
        this.count--;
      }
    }
  }
};
</script>