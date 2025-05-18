{if (count($arrErrors) > 0)}
    <section class="py-5 text-center container">
        <div class="alert alert-danger">
        {foreach $arrErrors as $strError}
            <p>{$strError}</p>
        {/foreach}
        </div>
    </section>
{/if}
{if (count($arrSuccess) > 0)}
    <section class="container text-center">
        <div class="alert alert-success">
            {foreach $arrSuccess as $strSuccess}
                <p>{$strSuccess}</p>
            {/foreach}
        </div>
    </section>
{/if}	