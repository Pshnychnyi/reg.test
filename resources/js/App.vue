<template>
    <div class="wrapper">
        <div class="wrapper-content">

            <section>
                <div class="container">
                    <header class="navbar">
                        <div class="navbar-content">
                            <div class="logo"></div>

                            <ul class="navbar-list">
                                <li class="navbar-item"><a @click="modal.signUp=!modal.signUp" class="navbar-link">Registration</a></li>
                            </ul>
                        </div>
                    </header>
                    <sign-up
                        v-show="modal.signUp"
                        @close="modal.signUp=false"
                    ></sign-up>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
import signUp from "../components/SignUp.vue";

export default {
    components: {
        signUp
    },
    data() {
        return {
            modal: {
                signUp: false,
            }
        }

    },
}
</script>

<style lang="scss">
.navbar-content {
    max-width: 1280px;
}
</style>
