<template>
  <div>
    <div>
      <p>{{ data.details[0].title }}</p>

      <img v-if="data.details[0].image" :src="data.details[0].image.url" width="200px"/>
    </div>
  </div>
</template>

<script>
  export default {
    name: "LinkedListView",
    props: {
      data: {
        type: Object,
        required: true
      }
    }
  }
</script>

<style scoped>

</style>
