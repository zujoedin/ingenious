<template>
  <div class="container">
  <div class="col-lg-12 col-12 mt-5">     
      <div class="row">
          <div v-if='loading' v-cloak class='text-center'>
              <div class="fa-3x">
                  <i class="fas fa-circle-notch fa-spin"></i>
              </div>  
          </div>
          
          <Table v-if='invoices.length>0' :invoices='invoices' :headers='headers' @onApproveReject="getInvoices"/>
                  
          <div v-else v-cloak>
              <h5 class='text-center'>No invoices found!</h5>
          </div>         
      </div> 
  </div>
  </div>
</template>

<script>
import axios from 'axios'
import Table from '../components/Table.vue'


export default {
  components: {
      Table,
  },
  data(){
      return {
          invoices:'',  
          headers:'',       
          loading:false,
      }
  },    
  mounted(){
    this.getInvoices()
    this.getInvoiceHeaders()
  },
  methods: {        
      getInvoices(){ 
          let self = this
          self.loading = true
          axios.get('/api/get-invoices',{
          }).then(function (response) {
              self.invoices = response.data               
              self.loading = false
          }).catch(function (error) {
              console.log(error);
          });        
      },
      getInvoiceHeaders(){ 
          let self = this
          self.loading = true
          axios.get('/api/get-invoice-headers',{
          }).then(function (response) {
              self.headers = response.data            
              self.loading = false
          }).catch(function (error) {
              console.log(error);
          });        
      },
     
  },
  
  
}

</script>
<style scoped>


</style>