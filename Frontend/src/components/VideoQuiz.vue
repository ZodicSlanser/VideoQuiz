<template>
    <div>
        <video v-if="renderVideo" ref="videoPlayer" width="640" height="360" controls @timeupdate="checkQuiz">
            <source :src="videoPath" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div v-if="showQuizOverlay" class="quiz-overlay">
            <p>{{ currentQuestion.question }}</p>
            <form @submit.prevent="submitAnswer">
                <div v-for="(option, index) in currentQuestion.options" :key="index">
                    <label>
                        <input type="radio" :value="index" v-model="selectedOption" /> {{ option }}
                    </label>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import serverURL from '@/constants';


export default {
    data() {
        return {
            videoPath: '',
            quizData: [],
            currentQuizIndex: 0,
            showQuizOverlay: false,
            currentQuestion: {},
            selectedOption: null,
            renderVideo: false,
        };
    },
    mounted() {
        this.loadVideoData();
    },
    methods: {
        async loadVideoData() {
            try {
                await axios.get(serverURL + "/api/videos/1").then(
                    (response) => {
                        let pathText = response.data.path;
                        this.videoPath = serverURL + "/" +pathText;
                        this.renderVideo = true;
                        console.log('Video data:', response.data);
                        this.quizData = response.data.quiz_questions;
                    }
                )

            } catch (error) {
                console.error('Error loading video data:', error);
            }
        },
        checkQuiz() {
            const videoPlayer = this.$refs.videoPlayer;
            if (
                this.currentQuizIndex < this.quizData.length &&
                videoPlayer.currentTime >= this.quizData[this.currentQuizIndex].seconds
            ) {
                videoPlayer.pause();
                this.showQuizOverlay = true;
                this.currentQuestion = this.quizData[this.currentQuizIndex];
            }
        },
        async submitAnswer() {
            const question = this.currentQuestion;
            const answer = this.selectedOption;

            try {
                await axios.post(serverURL + '/api/user-answers', {
                    user_id: 1, // Example user ID
                    quiz_question_id: question.id,
                    selected_option: answer,
                    correct: answer === question.correct_answer,
                });
                this.showQuizOverlay = false;
                this.currentQuizIndex++;
                this.selectedOption = null;
                this.$refs.videoPlayer.play();
            } catch (error) {
                console.error('Error saving answer:', error);
            }
        },
    },
};
</script>

<style scoped>
.quiz-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(255, 255, 255, 0.95);
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    width: 300px;
    text-align: center;
}
</style>
