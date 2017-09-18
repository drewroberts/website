<template>
    <v-app id="example-8" toolbar>
    <v-navigation-drawer absolute persistent light v-model="drawer" overflow>
      <v-list class="pa-1">
        <div style="width:200px;margin:auto;padding-top:10px;padding-bottom:10px;">
          <v-list-tile-avatar tag="div" size="200px">
            <img src="/img/drewroberts.jpg" />
          </v-list-tile-avatar>
        </div>
      </v-list>
      <v-list class="pt-0" dense>
        <v-divider light></v-divider>
        <v-list-tile :to="{ name: 'Home' }" exact>
          <v-list-tile-action>
            <v-icon light>mdi-home-automation</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Home</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile :to="{ name: 'About' }">
          <v-list-tile-action>
            <v-icon light>mdi-account-circle</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>About Me</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile :to="{ name: 'Backend' }">
          <v-list-tile-action>
            <v-icon light>mdi-database</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Backend Development</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile :to="{ name: 'Frontend' }">
          <v-list-tile-action>
            <v-icon light>web</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Frontend Development</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile :to="{ name: 'Marketing' }">
          <v-list-tile-action>
            <v-icon light>network_check</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Digital Marketing</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile :to="{ name: 'Analytics' }">
          <v-list-tile-action>
            <v-icon light>mdi-chart-areaspline</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Business Analytics</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile :to="{ name: 'Tools' }">
          <v-list-tile-action>
            <v-icon light>mdi-git</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Tools I Use</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar fixed dark dense class="indigo darken-4">
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
              <v-toolbar-title>Drew Roberts</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-bottom-sheet>
                    <v-btn small slot="activator" outline class="amber--text">Contact</v-btn>
                  <v-list>
                    <v-subheader>Reach out to me through:</v-subheader>
                    <v-list-tile href="https://www.facebook.com/DrewRoberts">
                          <v-list-tile-avatar>
                            <v-icon medium>mdi-facebook-box</v-icon>
                          </v-list-tile-avatar>
                          <v-list-tile-title>@DrewRoberts</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="https://twitter.com/DrewRoberts">
                          <v-list-tile-avatar>
                            <v-icon medium>mdi-twitter</v-icon>
                          </v-list-tile-avatar>
                          <v-list-tile-title>@DrewRoberts</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="https://www.linkedin.com/in/DrewRoberts">
                          <v-list-tile-avatar>
                            <v-icon medium>mdi-linkedin-box</v-icon>
                          </v-list-tile-avatar>
                          <v-list-tile-title>/DrewRoberts</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="https://github.com/DrewRoberts">
                          <v-list-tile-avatar>
                            <v-icon medium>mdi-github-circle</v-icon>
                          </v-list-tile-avatar>
                          <v-list-tile-title>@DrewRoberts</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="mailto:website@drewroberts.com?Subject=Hello%20Drew">
                          <v-list-tile-avatar>
                            <v-icon medium>mdi-comment-text-outline</v-icon>
                          </v-list-tile-avatar>
                          <v-list-tile-title>Contact Form</v-list-tile-title>
                    </v-list-tile>
                  </v-list>
                </v-bottom-sheet>
        </v-toolbar>
        <main class="grey lighten-4">
          <router-view
            class="view"
            keep-alive
            transition
            transition-mode="out-in">
          </router-view>
        </main>
    </v-app>
</template>

<script>
  export default {
    data () {
      return {
        drawer: null,
        items: [
          { title: 'Home', icon: 'dashboard', url: '/', click: 'visitHome' },
          { title: 'About', icon: 'question_answer', url: '/about', click: 'visitAbout' }
        ],
        mini: false,
        right: null
      }
    }
  }
</script>
