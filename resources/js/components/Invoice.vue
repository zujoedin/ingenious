<template>
   
	<div class="p-3 mt-2">
		<div class="container">
			<div class="row">
				<div class="col-6 text-left"><h4>{{ invoice?.company?.name }}</h4></div>
				<div class="col-6 text-right"><h4>INVOICE</h4></div>
			</div>
			<div class="row text-small">
				<div class="col-6">
					<div class="row">
						<div class="col-12">
							{{ invoice?.company?.address }}
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							{{ invoice?.company?.city }}, {{ invoice?.company?.state }} {{ invoice?.company?.zip }}
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							{{ invoice?.company?.phone }}
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							{{ invoice?.company?.email }}
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-5 text-small">
				<div class="col-4">
					<div class="row">
						<div class="col-12">
							<strong>Bill To</strong>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							{{ invoice?.company?.name }}
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							{{ invoice?.company?.address }}
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							{{ invoice?.company?.city }}, {{ invoice?.company?.state }} {{ invoice?.company?.zip }}
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							{{ invoice?.company?.phone }}
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							{{ invoice?.company?.email }}
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="row">
						<div class="col-12">
							<strong>Ship To</strong>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							{{ invoice?.company?.name }}
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							{{ invoice?.company?.address }}
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							{{ invoice?.company?.city }}, {{ invoice?.company?.state }} {{ invoice?.company?.zip }}
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							{{ invoice?.company?.phone }}
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							{{ invoice?.company?.email }}
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="row text-right">
						<div class="col-6">
							<strong>Invoice #</strong>
						</div>
						<div class="col-6">
							<strong>{{invoice?.number?.slice(0, 6)}}</strong>
						</div>
					</div>
					
					<div class="row text-right">
						<div class="col-6">
							<strong>Invoice Date</strong>
						</div>
						<div class="col-6">
							<strong>{{invoice?.date}}</strong>
						</div>
					</div>
					<div class="row text-right">
						<div class="col-6">
							<strong>P.O#</strong>
						</div>
						<div class="col-6">
							<strong>{{invoice?.date?.slice(0, 4)}}</strong>
						</div>
					</div>
					
					<div class="row text-right">
						<div class="col-6">
							<strong>Due Date</strong>
						</div>
						<div class="col-6">
							<strong>{{invoice?.due_date}}</strong>
						</div>
					</div>
					
				</div>				
			</div>
			<div class="row mt-5">
				<div class="col-12">
					<table class="table table-bordered">
						<thead >
							<tr class="">
								<th class="text-center table-active">QTY</th>
								<th class="text-center table-active">Description</th>
								<th class="text-center table-active">Unit Price</th>
								<th class="text-center table-active">Amount</th>
							</tr>
						</thead>
						<tbody>
							
							<tr v-for="item in invoice?.products">
								{{  }}							
								<td class="text-center">{{item.pivot.quantity}}</td>
								<td>{{item.name}}</td>							
								<td class="text-right">{{item.price}}</td>
								<td class="text-right">{{moneyformat(parseInt(item.price)*parseInt(item.pivot.quantity))}}</td>
							</tr>
							<tr>
								<td colspan="3" class="text-right">Subtotal</td>
								<td class="text-right">{{ moneyformat(calculateTotal) }}</td>
							</tr>
							<tr>
								<td colspan="3" class="text-right">Sales tax {{ salesTax }}%</td>
								<td class="text-right">{{ moneyformat(calculateSalesTax) }}</td>
							</tr>
							<tr>
								<td colspan="3" class="text-right"><h4>TOTAL</h4></td>
								<td class="text-right table-active">{{ moneyformat(calculateTotalWithTax) }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row text-small mt-5">
				<strong>Terms & Conditions</strong>
				<p>Payment is due within 15 days</p>
				<br>
				<p>Please make checks payable to: {{ invoice?.company?.name }}</p>
			</div>
		</div>
	
		

  	</div>
</template>

<script>



export default {
	components: {
		
	},
	props:['invoice'], 
	data(){
		return {
			salesTax: 6.25,
		}
	},    
	mounted(){
		
	},
	computed: {
		calculateTotal() {
			let invoiceArray = [];
			if(this.invoice.products){
				invoiceArray = Object.values(this.invoice.products);			
				invoiceArray = invoiceArray.reduce((total, item) => total + item.price*item.pivot.quantity, 0);
			}
			return invoiceArray
		},
		calculateSalesTax() {				
			return this.salesTax/100*this.calculateTotal;
		},

		calculateTotalWithTax() {				
			return this.calculateTotal+this.calculateSalesTax;
		},
  	},
  	watch:{
       
	},
  	methods: {        
		moneyformat(value){
			if(this.invoice.products)
			return value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');	
		},  
  
	},
}

</script>
<style scoped>
.text-right{
	text-align: right;
}
.text-left{
	text-align: left;
}
.text-small{
	font-size: 12px;
}
.text-center{
	text-align: center;
}
.table-bordered{
	border-color: #808080;
}
table{
	font-weight: bold;
}
</style>