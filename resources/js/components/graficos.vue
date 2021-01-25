<template>
  <div class="sm">
    <h4>Recettes / dépenses</h4>
    <line-chart :chart-data="datacollection" :height="100"></line-chart>
  </div>
</template>

<script>

import LineChart from './LineChart.js'

export default {
  components: {
    LineChart
  },
  data(){
    return {
      datacollection: null
    }
  },
  mounted () {
    this.fillData()
  },
  methods: {

    fillData ()
    {
      this.datacollection = {
        labels: ['Janvier','Fevrier','Mars','Avril','Mai', 'Juin' , 'Juillet','Septembre','Novembre','Decembre'],
        datasets: [
          {
            label: 'Payer',
            backgroundColor: '#FF0066',
            data: [ 20, 40, 50, 20, 50, 40,70,89,67,12,11,12]
          },
        ]
      }
    }
  }
}
</script>

<style lang="css">
.sm {
  max-width: 800px;
  /* max-height: 500px; */
  margin:  50px auto;
}
</style>