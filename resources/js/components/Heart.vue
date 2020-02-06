<template>
  <div id="app">
    <button v-if="!Heart" type="submit" class="btn p-0 border-0 text-primary" @click="addLike">
      <i class="far fa-heart fa-fw"></i>
      {{ count }}
    </button>
    <button v-else type="submit" class="btn p-0 border-0 text-danger">
      <i class="fas fa-heart fa-fw" @click="addLike"></i>
      {{ count }}
    </button>
  </div>
</template>
<script>
export default {
  data() {
    return {
      Heart: false,
      count: 0
    };
  },
  methods: {
    addLike() {
      if (this.count === 0) {
        this.count++;
        this.Heart = true;
      } else {
        this.count--;
        this.Heart = false;
      }
    }
  }
};
</script>