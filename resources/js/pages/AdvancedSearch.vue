<template>
  <div>
      <div v-for="apartment in apartments" :key="apartment.id">
          {{apartment.title}}
          ciaooooo
      </div>

  </div>
</template>

<script>
export default {
    props: {
         apartments: Array,
    }
}
</script>

<style lang="scss" scoped>

</style>