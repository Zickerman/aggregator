<template>
	<div class="main">
		<h1>Введите ссылку для проверки</h1>
		<form @submit.prevent="submitForm" class="form">

			<div>
				<label for="url">URL для проверки:</label>
				<input v-model="form.url" type="url" id="url" required placeholder="Введите URL">
			</div>
			<div>
				<label for="frequency">Частота проверки (мин.):</label>
				<select v-model="form.frequency" id="frequency" required>
					<option value="1">1 минута</option>
					<option value="5">5 минут</option>
					<option value="10">10 минут</option>
				</select>
			</div>
			<div>
				<label for="retries">Количество повторов при ошибке:</label>
				<input v-model.number="form.retries" type="number" id="retries" min="0"
					placeholder="Введите количество">
			</div>
			<div>
				<label for="delay">Задержка между повторениями (мин.):</label>
				<input v-model.number="form.delay" type="number" id="delay" min="0" placeholder="Введите задержку">
			</div>
			<button type="submit">Создать</button>
		</form>
	</div>
</template>

<script>
import axios from 'axios';

export default {
	data() {
		return {
			form: {
				url: '',
				frequency: '1',
				retries: 0,
				delay: 0,
			},
		};
	},
	methods: {
		async submitForm() {
			try {
				const response = await axios.post('/send-link-to-check', this.form);
				alert(response.data.message);
			} catch (error) {
				if (error.response) {
					alert(error.response.data.message);
				} else {
					console.error('Ошибка при запросе:', error.message);
				}
			}
		},
	},
};
</script>

<style>
.form {
	max-width: 400px;
	margin: auto;
	padding: 20px;
	border: 1px solid #ccc;
	border-radius: 5px;
}

.form div {
	margin-bottom: 15px;
}

.form label {
	display: block;
	margin-bottom: 5px;
}

.form input,
.form select {
	width: 100%;
	padding: 8px;
	box-sizing: border-box;
}

.main {
	color: black;
}

.main h1 {
	text-align: center;
}
</style>