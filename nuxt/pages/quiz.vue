<template>
  <section class="section">
    <div class="container">
      <div class="bd-example">
        <div class="content is-large">
          <h1>Hello World</h1>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla
            accumsan, metus ultrices eleifend gravida, nulla nunc varius lectus,
            nec rutrum justo nibh eu lectus. Ut vulputate semper dui. Fusce erat
            odio, sollicitudin vel erat vel, interdum mattis neque.
          </p>
        </div>
      </div>
      <div class="buttons mt-6 is-centered">
        <button class="button is-primary is-large">Check the price</button>
      </div>
      <div class="content">
        <h1>{{ quiz.title }}</h1>
      </div>

      <div class="row">
        <div class="large-12 columns">
          <div>
            <div v-for="(question, index) in quiz.questions">
              <!-- Hide all questions, show only the one with index === to current question index -->
              <div v-show="index === questionIndex">
                <span v-if="buttons === true">
                  <h3>Are you malaysian</h3>
                  <button class="button is-rounded" @click="local">Yes</button>
                  <button class="button is-rounded" @click="foreign">No</button>
                </span>
                <h3 v-if="button_next === true">{{ question.text }}</h3>
                <!-- Questions Begin -->
                <!-- Question type is select -->
                <div v-if="question.type === 'select'">
                  <div v-if="malaysian === false">
                    <div class="select">
                      <select v-model="country">
                        <option v-for="response in question.responses">{{
                          response.text
                        }}</option>
                      </select>
                    </div>
                  </div>
                </div>
                <!-- Question type is date -->
                <div v-if="question.type === 'date'">
                  <input
                    v-model="birthdate"
                    class="input is-medium"
                    type="date"
                  />
                </div>
                <!-- Question type is radio -->
                <div v-if="question.type === 'radio'">
                  <ol v-for="response in question.responses">
                    <!-- for each response of the current question -->
                    <li>
                      <label>
                        <input
                          type="radio"
                          :value="response.value"
                          v-model="position"
                        />
                        {{ response.text }}
                      </label>
                    </li>
                  </ol>
                </div>

                <!-- Question type is checkbox -->
                <div v-if="question.type === 'checkbox'">
                  <label
                    v-for="response in question.responses"
                    class="checkbox"
                  >
                    <input
                      type="checkbox"
                      v-model="response.text"
                      :value="checkbox"
                    />
                    {{ response.text }}
                  </label>
                </div>

                <!-- Question type is text -->
                <div v-if="question.type === 'textarea'">
                  <textarea class="textarea" v-model="textarea">
Write your text </textarea
                  >
                </div>
                <!-- Questions End -->
                <!-- The two navigation buttons -->
                <!-- Note: prev is hidden on first question -->
                <button
                  class="secondary button"
                  v-if="questionIndex > 0"
                  v-on:click="prev"
                >
                  prev
                </button>
                <button
                  v-if="button_next"
                  class="success button"
                  v-on:click="next"
                >
                  next
                </button>
              </div>
            </div>

            <!-- Last page, quiz is finished, display result -->
            <div v-show="questionIndex === quiz.questions.length">
              <h3>Your Results</h3>
              <p>Results: {{ result() }}</p>
            </div>
            <div class="column"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data: () => ({
    buttons: true,
    malaysian: true,
    country: "",
    birthdate: "",
    position: "",
    textarea: "",
    checkbox: [],
    button_next: false,
    quiz: {
      title: "Check which package is suitable",
      questions: [
        {
          text: "Choose your country?",
          type: "select",
          responses: [
            {
              text: "Indonesia",
              value: "in"
            },
            {
              text: "Thailand",
              value: "th"
            },
            {
              text: "Singapour",
              value: "sg"
            },
            {
              text: "Other",
              value: "other"
            }
          ]
        },
        {
          text: "What is your birthday?",
          type: "date"
        },
        {
          text: "What is your position?",
          type: "radio",
          responses: [
            {
              text: "Manager",
              value: "manager"
            },
            {
              text: "Assistant Director",
              value: "asistan"
            },
            {
              text: "Director",
              value: "director"
            }
          ]
        },
        {
          text: "What's your favourite colour?",
          type: "checkbox",
          responses: [
            {
              text: "Black",
              value: "black"
            },
            {
              text: "Red",
              value: "red"
            },
            {
              text: "Blue",
              value: "blue"
            }
          ]
        },
        {
          text: "Anything special?",
          type: "textarea"
        }
      ]
    },
    questionIndex: 0,
    userResponses: Array()
  }),
  methods: {
    // Go to next question
    local: function() {
      console.log(this.questionIndex);
      this.questionIndex++;
      this.buttons = false;
      this.button_next = true;
      this.country = "Malaysia";
    },
    foreign: function() {
      this.button_next = true;
      this.malaysian = false;
      this.buttons = false;
    },
    // Go to next question
    next: function() {
      this.questionIndex++;
    },
    // Go to previous question
    prev: function() {
      this.questionIndex--;
    },
    result: function() {
      //find the highest occurence in responses
      var result = {
        country: this.country,
        birthdate: this.birthdate,
        position: this.position,
        textarea: this.textarea,
        checkbox: this.checkbox
      };

      return result;
    }
  }
};
</script>
