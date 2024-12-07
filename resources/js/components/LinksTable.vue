<template>
	<div class="table">
	  <h1>Список ссылок</h1>
	  <table class="table-auto border w-full">
		<thead>
		  <tr class="bg-gray-100">
			<th>ID</th>
			<th>URL</th>
			<th>Частота (мин)</th>
			<th>Повторы</th>
			<th>Обновлено</th>
		  </tr>
		</thead>
		<tbody>
		  <template v-if="links.length > 0">
			<tr v-for="link in links" :key="link.id" class="odd:bg-white even:bg-gray-50">
			  <td>{{ link.id }}</td>
			  <td>{{ link.url }}</td>
			  <td>{{ link.frequency }}</td>
			  <td>{{ link.retries }}</td>
			  <td>{{ link.updated_at }}</td>
			</tr>
		  </template>
		  <template v-else>
			<tr>
			  <td colspan="5">Нет данных для отображения</td>
			</tr>
		  </template>
		</tbody>
	  </table>
	</div>
</template>

<script>
export default {
	props: {
	  links: {
		type: Array,
		required: true,
	  },
	},
};
</script>

<style scoped>
table {
  border-collapse: collapse;
  width: 100%;
  text-align: center;
  color: #000;
}

th, td {
  border: 1px solid #d1d5db;
  padding: 0.5rem;
}

th {
  background-color: #f3f4f6;
  color: #000;
  font-weight: bold;
  text-align: center;
}

tbody tr:nth-child(odd) {
  background-color: #ffffff;
}

tbody tr:nth-child(even) {
  background-color: #f9fafb;
}

h1 {
  color: #000;
  font-size: 1.5rem;
  text-align: center;
  margin-bottom: 1rem;
}
</style>
