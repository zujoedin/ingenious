<template>
   
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ invoice.number }}</h5>		
        <button type="button" class="btn-close" data-bs-dismiss="modal" @click="closeModal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Reject</button>
        <button type="button" class="btn btn-sucess">Accept</button>
      </div>
    </div>
  </div>
</div> -->

<div v-if="showModal">
    <transition name="modal">
      <div class="modal-mask">
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Invoice number: <strong>{{ invoice.number }}</strong></h5>
                        <button type="button" class="btn-close" @click="showModal=false" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <Invoice :invoice="invoice" ></Invoice>
                    </div>
                    <div class="modal-footer">
						
						<div v-if="invoice.status == 'draft'">
							<button type="button" class="btn btn-danger m-2" @click="approveReject(invoice.id,false)">Reject</button>
							<button type="button" class="btn btn-success" @click="approveReject(invoice.id,true)">Accept</button>
						</div>
						<div v-else>
							<div  v-if="invoice.status=='approved'" class="alert alert-success">Invoice has been approved</div>
							<div  v-else class="alert alert-danger">Invoice has been rejected</div>
						</div>

                    </div>
                </div>
            </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>

import Invoice from './Invoice.vue'

export default {
  components: {
    Invoice
  },
  props:['invoice','showModal'], 
  data(){
      return {    
      }
  },    
  mounted(){   
  },
 
  methods: {       
	approveReject(id,status){ 		
          let self = this		
		 
          axios.post('/api/approve-reject',{
			id:id,
			status:status
          }).then(function (response) {
				self.$emit("onApproveReject", response.data)
				// console.log(self.invoice)
          }).catch(function (error) {
              console.log(error);
          });        
    },
     
  },
  
  
}

</script>
<style scoped>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0,0.3);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal{
	display: block;
}

</style>