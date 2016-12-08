<p><?= dgettext('lizenzstatus', 'Auf dieser Seite k�nnen Lehrende gesucht werden und zum Bearbeiten ihrer Dateien ausgew�hlte werden.') ?></p>
<? if (!$error): ?>
<form name="search" action="" method="post" class="default">
    <fieldset>
        <legend><?= dgettext('lizenzstatus', 'Suche nach Lehrenden'); ?></legend>
        <label>
            <?= dgettext('lizenzstatus', 'Name des Lehrenden') . ':'; ?>
            <input type="text" minlength="2" name="user_name"
                value="<?= htmlReady($user_name) ?>">
        </label>
    </fieldset>
    <?= \Studip\Button::create(dgettext('lizenzstatus', 'Suchen')) ?>
</form>
<? if($search_was_executed): ?>
<table class="default">
    <caption><?= dgettext('lizenzstatus', 'Suchergebnisse') ?>&nbsp;(<?=count($users)?>)</caption>
    <thead>
        <tr>
            <th><?= dgettext('lizenzstatus', 'Name des Lehrenden') ?></th>
            <th><?= dgettext('lizenzstatus', 'Anzahl Dateien') ?></th>
        </tr>
    </thead>
    <tbody>
    <? if($users): ?>
        <? foreach ($users  as $user): ?>
        <tr>
            <td>
                <a href="<?= PluginEngine::getLink(
                    $plugin,
                    array(
                        'user_id' => $user->id
                    ),
                    'my/files'
                ) ?>"><?= (version_compare($GLOBALS['SOFTWARE_VERSION'], '3.1', '>='))
                    ? htmlReady($user->getFullName())
                    : htmlReady($user->name) ?></a>
            </td>
            <td>
                <?= htmlReady($user_files_count[$user->id]) ?>
            </td>
        </tr>
        <? endforeach ?>
    <? else: ?>
    <tr><td colspan="2"><?= dgettext('lizenzstatus', 'Es wurden keine Lehrenden gefunden!') ?></td></tr>
    <? endif ?>
    </tbody>
</table>
<? endif ?>
<? endif ?>
