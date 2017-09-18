<template>
	<v-container
		fluid
		style="max-width: 970px;"
		grid-list-lg
	>
		<v-layout row wrap>
			<v-flex xs12 sm6 offset-sm3>
				<v-card hover @click="visitAbout">
					<v-card-media
						class="white--text"
						height="200px"
						src="https://vuetifyjs.com/static/doc-images/cards/desert.jpg"
					>
					</v-card-media>
					<v-card-title>
						<div>
							<span>About Me</span><br>
							<span class="grey--text">I live in Orlando and enjoy full stack web development, digital marketing, and business analytics...</span>
						</div>
					</v-card-title>
					<v-card-actions>
						<v-btn flat class="orange--text">Read More</v-btn>
					</v-card-actions>
				</v-card>
			</v-flex>
		</v-layout>
		<v-layout row wrap>
			<v-flex xs12 sm6 offset-sm3>
				<v-card hover @click="visitAbout">
					<v-card-media
						class="white--text"
						height="200px"
						src="https://vuetifyjs.com/static/doc-images/cards/desert.jpg"
					>
					</v-card-media>
					<v-card-title>
						<div>
							<span>Backend Web Development</span><br>
							<span class="grey--text">I create Databases and API's with Laravel.</span>
						</div>
					</v-card-title>
					<v-card-actions>
						<v-btn flat class="orange--text">Read More</v-btn>
					</v-card-actions>
				</v-card>
			</v-flex>
		</v-layout>
		<v-layout row wrap>
			<v-flex xs12 sm6 offset-sm3>
				<v-card hover @click="visitAbout">
					<v-card-media
						class="white--text"
						height="200px"
						src="https://vuetifyjs.com/static/doc-images/cards/desert.jpg"
					>
					</v-card-media>
					<v-card-title>
						<div>
							<span>Frontend Web Development</span><br>
							<span class="grey--text">I create Progrssive Web Apps with Vue and use a few design frameworks to style my projects.</span>
						</div>
					</v-card-title>
					<v-card-actions>
						<v-btn flat class="orange--text">Read More</v-btn>
					</v-card-actions>
				</v-card>
			</v-flex>
		</v-layout>
		<v-layout row wrap>
			<v-flex xs12 sm6 offset-sm3>
				<v-card hover @click="visitAbout">
					<v-card-media
						class="white--text"
						height="200px"
						src="https://vuetifyjs.com/static/doc-images/cards/desert.jpg"
					>
					</v-card-media>
					<v-card-title>
						<div>
							<span>Digital Marketing</span><br>
							<span class="grey--text">I utilize SEO strategies, AdWords & other advertising platforms, and social media broadcasts to drive traffic and engagement to content.</span>
						</div>
					</v-card-title>
					<v-card-actions>
						<v-btn flat class="orange--text">Learn More</v-btn>
					</v-card-actions>
				</v-card>
			</v-flex>
		</v-layout>
		<v-layout row wrap>
			<v-flex xs12 sm6 offset-sm3>
				<v-card hover @click="visitAbout">
					<v-card-media
						class="white--text"
						height="200px"
						src="https://vuetifyjs.com/static/doc-images/cards/desert.jpg"
					>
					</v-card-media>
					<v-card-title>
						<div>
							<span>Business Analytics</span><br>
							<span class="grey--text">Accurately measuring Key Performance Indicators and Return on Investment is crucial to every business. I enjoy using a variety of tools and techniques to gather information and make decisions based on this data.</span>
						</div>
					</v-card-title>
					<v-card-actions>
						<v-btn flat class="orange--text">Read More</v-btn>
					</v-card-actions>
				</v-card>
			</v-flex>
		</v-layout>
	</v-container> 
</template>

<script>
	export default {
		methods: {
			visitAbout() {
				this.$router.push('/about');
			}
		}
	}
</script>