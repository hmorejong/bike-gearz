<?php

namespace App\Service;

class MessageGenerator
{

    public function getHappyMessage(): string
    {
        $messages = [
            "Ta-da! 🎩✨ You've just conjured up some digital magic. Your entry is now safely tucked away in a digital vault.",
            "Congratulations! Your entry has been accepted into the Hall of Records. It's now part of our web app's history.",
            "Hooray! Your data has officially joined the party. You're the life of the data-entry fiesta bike!",
            "Mission 'Insertion Accomplished!' Your data is now on board and ready to rock our web app.",
            "You've just leveled up in data wizardry! Your entry has become part of our app's enchanting tapestry.",
            "Insertion complete! Your data has found its forever home in our app's cozy database. Welcome to the family!"
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }


}