<nav class=" justify-content-between">
    <ul>
        <li><a href="index.php?ctrl=animal&action=home" class="{if ($strPage == 'accueil')} active {/if}">Accueil</a></li>
        <li><a href="index.php?ctrl=animal&action=list_animal" class="{if ($strPage == 'list_animal')} active {/if}">Nos Animaux</a></li>
        <li><a href="index.php?ctrl=event&action=home_event" class="{if ($strPage == 'event')} active {/if}">Événements</a></li>
        <li><a href="index.php?ctrl=testify&action=home_testify" class="{if ($strPage == 'testify')} active {/if}">Témoignages</a></li>
        <li><a href="index.php?ctrl=page&action=contact" class="{if ($strPage == 'contact')} active {/if}">Contact</a></li>
    </ul>
</nav>

