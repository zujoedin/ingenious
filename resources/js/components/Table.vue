<template>
   
	<div class="table-responsive p-3 mt-2">

		<table class="table">
			<thead>
				<tr>
					<th v-for='(header, index) in headers'>{{ toCamel(header) }}</th>
					<th>Action</th>
					
				</tr>
			</thead>
			<tbody>
				<tr v-for='(invoice, index) in invoices'>
					<td>{{ invoice.id.slice(0, 6)}}</td>
					<td>{{ invoice.number.slice(0, 6) }}</td>
					<td>{{ toProperDate(invoice.date) }}</td>
					<td>{{ toProperDate(invoice.due_date) }}</td>
					<td>{{ invoice.company_id.slice(0, 4) }}</td>
					<td>{{ invoice.status }}</td>
					<td>{{ toProperDate(invoice.created_at) }}</td>
					<td>{{ toProperDate(invoice.updated_at) }}</td>
					<td><button class="btn btn-primary" @click="getInvoice(invoice.id)"><span class="fa fa-search"></span>Show</button></td>
				</tr>
				
			</tbody>
		</table>
		<Modal :showModal="showModal" :invoice="invoice" @onApproveReject="onApproveReject"></Modal>

  	</div>
</template>

<script>


import Modal from '../components/Modal.vue'

export default {
	components: {
		Modal,
	},
	props:['invoices','headers'], 
	data(){
			return {
				showModal:false,
				invoice:{},
				invoice_id: '',
			}
	},    
	mounted(){
		
	},
  	watch:{
        showModal(value){
            this.$emit("onShowModal",value)
        },
	},
  	methods: {        
		toCamel(string){
			return string.replace(/(?:_| |\b)(\w)/g, function($1){return $1.toUpperCase().replace('_',' ')});
		},
		toProperDate(date){
			let newDate = new Date(date);
			newDate = (newDate.getMonth() + 1) + '/' + newDate.getDate() + '/' + newDate.getFullYear()		
			return newDate
		},
		getInvoice(id){ 		
			let self = this		
			self.showModal = true  
			axios.post('/api/get-invoice',{
				id:id,
			}).then(function (response) {
				self.invoice = response.data    
			}).catch(function (error) {
				console.log(error);
			})       
		},
		onApproveReject(invoice){
			this.$emit("onApproveReject", invoice)
			this.invoice = invoice
		}
  	},
  
  
}

</script>
<style scoped>

</style>