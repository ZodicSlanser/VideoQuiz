# Interactive Video Quiz

### This Project has been done as PoC for VERO Advanced Solutions.

This project is a Laravel-based web application that plays a video and prompts the user to answer multiple-choice questions (MCQs) at specific times during the video. The user's answers are then saved for further processing.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Usage](#usage)
- [Folder Structure](#folder-structure)
- [Contributing](#contributing)
- [License](#license)

## Prerequisites

Before you begin, ensure you have met the following requirements:

- [PHP](https://www.php.net/downloads) >= 7.4
- [Composer](https://getcomposer.org/download/)
- [Node.js](https://nodejs.org/en/download/) and npm
- [Laravel](https://laravel.com/docs/8.x/installation) >= 8

## Installation

Follow these steps to install the project:

1. Clone the repository:

    ```bash
    git clone https://github.com/your-username/interactive-video-quiz.git
    cd interactive-video-quiz
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Install JavaScript dependencies:

    ```bash
    npm install
    ```

4. Create a copy of the `.env` file:

    ```bash
    cp .env.example .env
    ```

5. Generate an application key:

    ```bash
    php artisan key:generate
    ```

6. Compile the assets:

    ```bash
    npm run dev
    ```

7. Serve the application:

    ```bash
    php artisan serve
    ```

    The application will be available at `http://localhost:8000`.

## Usage

1. Place your video file in the `public/videos` directory. The video file should be named `video.mp4`.

2. Add your questions, options, answers and time in seconds in object array in `public/js/app.js` file.

eg. 
```javascript
const quizData = [
    {
        seconds: 10, //in seconds
        question: "Which subject's project is Saif explaining?",
        options: ["Compiler", "OS", "System Analysis", "Embedded Systems"],
        correctAnswer: 0 //index of the correct answer in options array
    },
    {
        seconds: 17,
        question: "What was Saif's Academic Number?",
        options: ["200500", "260300", "200345", "200346"],
        correctAnswer: 3
    }
];

```
3. Do steps 6, 7 from Installation section.

4. Open the application in your web browser at `http://localhost:8000`.

5. The video will start playing, and at specific times, a quiz overlay will appear, prompting the user to answer a multiple-choice question.

6. The user's answer will be saved, and the video will resume playing.

## Folder Structure

Here is an overview of the key files and directories in this project:

```
project-root/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── QuizController.php
├── public/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   └── app.js
│   └── videos/
│       └── video.mp4
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   └── app.js
│   └── views/
│       └── quiz.blade.php
├── routes/
│   └── web.php
├── .env.example
├── package.json
├── webpack.mix.js
└── README.md
```

## Contributing

To contribute to this project, follow these steps:

1. Fork this repository.
2. Create a branch: `git checkout -b feature-branch`.
3. Make your changes and commit them: `git commit -m 'Add feature'`.
4. Push to the original branch: `git push origin feature-branch`.
5. Create a pull request.

Alternatively, see the GitHub documentation on [creating a pull request](https://docs.github.com/en/github/collaborating-with-issues-and-pull-requests/creating-a-pull-request).

## License

