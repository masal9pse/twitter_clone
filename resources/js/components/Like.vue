<template>
  <div class="container">
    <button type="submit" class="btn btn-primary">Like</button>
  </div>
</template>

<script>
export default {
  props: ["post-id"],
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
