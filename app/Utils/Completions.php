<?php

/**
 * Utility for processing tags in text.
 *
 * @package   App
 *
 * @copyright YetiForce Sp. z o.o
 * @license   YetiForce Public License 3.0 (licenses/LicenseEN.txt or yetiforce.com)
 * @author    Arkadiusz Adach <a.adach@yetiforce.com>
 */

namespace App\Utils;

/**
 * Completions class.
 */
class Completions
{
	/**
	 * Format HTML.
	 *
	 * @var string
	 */
	const FORMAT_HTML = 'HTML';
	/**
	 * Format Text.
	 *
	 * @var string
	 */
	const FORMAT_TEXT = 'Text';
	/**
	 * Path to emoji.json.
	 *
	 * @var string
	 */
	const PATH_EMOJI_JSON = 'public_html/vendor/ckeditor/ckeditor/plugins/emoji/emoji.json';
	/**
	 * Emoji regex patter.
	 *
	 * @var string
	 */
	const EMOJI_REGEX = '/\:{2}[^\:]+\:{2}/';
	/**
	 * Record and Users regex patter.
	 *
	 * @var string
	 */
	const ROW_REGEX = '/(\##|\@@)(\d+)_([^\##|\@@]+)(\##|\@@)/u';
	/**
	 * Owner separator.
	 *
	 * @var string
	 */
	const OWNER_SEPARATOR = '@@';
	/**
	 * Record separator.
	 *
	 * @var string
	 */
	const RECORD_SEPARATOR = '##';

	/**
	 * Get processed text in display mode.
	 *
	 * @param string $text
	 * @param string $format
	 *
	 * @return string
	 */
	public static function decode(string $text, string $format = self::FORMAT_HTML): string
	{
		$emojis = static::getEmojis();
		$textOut = \preg_replace_callback(
			static::EMOJI_REGEX,
			function (array $matches) use ($emojis) {
				return $emojis[$matches[0]] ?? $matches[0];
			},
			$text
		);
		return \preg_replace_callback(
			static::ROW_REGEX,
			function (array $matches) use ($format) {
				return static::decodeRow($matches[0], $matches[1], (int) $matches[2], $matches[3], $format);
			},
			$textOut
		);
	}

	/**
	 * Get processed text in display Emoji.
	 *
	 * @param string $text
	 *
	 * @return string
	 */
	public static function decodeEmoji(string $text): string
	{
		$emojis = static::getEmojis();
		return \preg_replace_callback(
			static::EMOJI_REGEX,
			function (array $matches) use ($emojis) {
				return $emojis[$matches[0]] ?? $matches[0];
			},
			$text
		);
	}

	/**
	 * Get text to edit mode.
	 *
	 * @param string $text
	 *
	 * @throws \App\Exceptions\AppException
	 *
	 * @return string
	 */
	public static function encode(string $text): string
	{
		$emojis = static::getEmojis();
		$textOut = \preg_replace_callback(
			static::EMOJI_REGEX,
			function (array $matches) use ($emojis) {
				return $emojis[$matches[0]] ?? $matches[0];
			},
			$text
		);
		return \preg_replace_callback(
			static::ROW_REGEX,
			function (array $matches) {
				$type = $matches[1];
				$id = (int) $matches[2];
				if (self::OWNER_SEPARATOR === $type) {
					$label = static::decodeOwnerText($id, '-');
				} elseif (self::RECORD_SEPARATOR === $type) {
					$label = static::decodeRecordText($id, '-');
				} else {
					$label = '';
				}
				return "<a href=\"#\" data-id=\"{$type}{$id}\">{$label}</a>";
			},
			$textOut
		);
	}

	/**
	 * Process before writing to the database.
	 *
	 * @param string $text
	 *
	 * @return string
	 */
	public static function encodeAll(string $text): string
	{
		return static::encodeRow(static::encodeEmoji($text));
	}

	/**
	 * Process before writing to the database.
	 *
	 * @example FROM: 😀 TO: :grinning_face:
	 *
	 * @param string $text
	 *
	 * @throws \App\Exceptions\AppException
	 *
	 * @return string
	 */
	public static function encodeEmoji(string $text): string
	{
		$emojis = array_flip(static::getEmojis());
		return str_replace(array_keys($emojis), $emojis, $text);
	}

	/**
	 * Process before writing to the database.
	 *
	 * @example FROM: <a href='#' data-id='@115'>text</a> TO: @@115@@
	 *
	 * @param string $text
	 *
	 * @return string
	 */
	public static function encodeRow(string $text): string
	{
		return \preg_replace_callback(
			"/<a\\s+[^>]*data-id=(?:\"|')(.)(\\d+)(?:\"|')[^>]*>[^<]+<\\/a>/i",
			function (array $matches) {
				$type = $matches[1];
				$recordName = strip_tags($matches[0]);
				return "{$type}{$type}{$matches[2]}_{$recordName}{$type}{$type}";
			},
			$text
		);
	}

	/**
	 * Get array of emojis.
	 *
	 * @throws \App\Exceptions\AppException
	 *
	 * @return array
	 */
	private static function getEmojis(): array
	{
		if (\App\Cache::has('App\Utils\Text', 'emojis')) {
			$emojis = \App\Cache::get('App\Utils\Text', 'emojis');
		} elseif (\file_exists(static::PATH_EMOJI_JSON)) {
			$emojis = [];
			foreach (\App\Json::decode(\file_get_contents(static::PATH_EMOJI_JSON)) as $val) {
				$emojis[':' . $val['id'] . ':'] = $val['symbol'];
			}
			\App\Cache::save('App\Utils\Text', 'emojis', $emojis);
		} else {
			$emojis = [];
		}
		return $emojis;
	}

	/**
	 * Get processed text in display mode.
	 *
	 * @param string $baseText
	 * @param string $type
	 * @param int    $id
	 * @param string $label
	 * @param string $format
	 *
	 * @return string
	 */
	private static function decodeRow(string $baseText, string $type, int $id, string $label, string $format = self::FORMAT_HTML): string
	{
		$html = '';
		if (self::RECORD_SEPARATOR === $type) {
			switch ($format) {
				case static::FORMAT_HTML:
					$html = static::decodeRecord($id, $label);
					break;
				case static::FORMAT_TEXT:
					$html = static::decodeRecordText($id, $label);
					break;
				default: break;
			}
		} elseif (self::OWNER_SEPARATOR === $type) {
			switch ($format) {
				case static::FORMAT_HTML:
					$html = static::decodeOwner($id, $label);
					break;
				case static::FORMAT_TEXT:
					$html = static::decodeOwnerText($id, $label);
					break;
				default: break;
			}
		} else {
			$html = $baseText;
		}
		return $html;
	}

	/**
	 * Display record text.
	 *
	 * @param int    $recordId
	 * @param string $recordLabel
	 *
	 * @return string
	 */
	private static function decodeRecordText(int $recordId, string $recordLabel): string
	{
		if (\App\Record::isExists($recordId)) {
			$html = \App\Record::getLabel($recordId);
		} else {
			$html = static::deletedRecordTemplate($recordLabel);
		}
		return $html;
	}

	/**
	 * Display record.
	 *
	 * @param int    $recordId
	 * @param string $recordLabel
	 *
	 * @return string
	 */
	private static function decodeRecord(int $recordId, string $recordLabel): string
	{
		if (!($moduleName = \App\Record::getType($recordId))) {
			$html = static::deletedRecordTemplate($recordLabel);
		} elseif (\App\Privilege::isPermitted($moduleName, 'DetailView', $recordId)) {
			$html = "<a href=\"index.php?module={$moduleName}&view=Detail&record={$recordId}\" class=\"js-popover-tooltip--record\" target=\"_blank\" data-id=\"#{$recordId}\">" .
				$recordLabel . '</a>&nbsp;';
		} else {
			$html = $recordLabel;
		}
		return $html;
	}

	/**
	 * Display owner.
	 *
	 * @param int    $userId
	 * @param string $recordLabel
	 *
	 * @return string
	 */
	private static function decodeOwner(int $userId, string $recordLabel): string
	{
		if (!\App\User::isExists($userId)) {
			$html = static::deletedRecordTemplate($recordLabel);
		} else {
			$isRecordPermitted = \App\User::getCurrentUserModel()->isAdmin();
			$popoverRecordClass = $isRecordPermitted ? 'js-popover-tooltip--record' : '';
			$popoverRecordHref = $isRecordPermitted ? "index.php?module=Users&view=Detail&record={$userId}" : '#';
			$html = "<a class=\"js-completions__tag $popoverRecordClass\" href=\"$popoverRecordHref\" data-id=\"@$userId\" data-js=\"click\">" .
				\App\User::getUserModel($userId)->getName() .
				'</a>';
		}
		return $html;
	}

	/**
	 * Display owner text.
	 *
	 * @param int    $userId
	 * @param string $recordLabel
	 *
	 * @return string
	 */
	private static function decodeOwnerText(int $userId, string $recordLabel): string
	{
		if (\App\User::isExists($userId)) {
			$html = \App\User::getUserModel($userId)->getName();
		} else {
			$html = static::deletedRecordTemplate($recordLabel);
		}
		return $html;
	}

	/**
	 * Display deleted record template.
	 *
	 * @param string $recordLabel
	 *
	 * @return string
	 */
	private static function deletedRecordTemplate(string $recordLabel): string
	{
		return "<span class=\"text-strike\">{$recordLabel}</span>";
	}

	// Text functions
	private const IF_REGEXP = '/~~~IF *(?<condition>.*?) *(IF)?~~~(?<iftrue>.*?)~~~FI~~~/s';
	private const SPELLOUT_REGEXP = '/SPELLOUT\[(?<number>.*?)\]/s';
	private const TAG_REMOVER_REGEXP = '/<[^>]+>/s';
	private const COMMENT_REMOVER_REGEXP = '/\*(.*?)\*/s';
	private const PLACEHOLDER_REGEXP = '/(@(<[^>]+>)*@|<(<[^>]+>)*<|&lt;(<[^>]+>)*&lt;)(<[^>]+>)*(?<placeholder>([a-zA-Z0-9_\.\-](<[^>]+>)*)+?)(<[^>]+>)*(>(<[^>]+>)*>|@(<[^>]+>)*@|&gt;(<[^>]+>)*&gt;)/s';

	public static function processIfCondition(string $conditionString, \App\TextParser $textParser): bool {
		$condition = \App\Json::decode($textParser->setContent($conditionString)->parse()->getContent());
		return \App\Condition::checkConditions($condition, $textParser->recordModel);
	}

	/**
	 * Processes special text function - ~~~IF condition~~~text~~~FI~~~, that is replaced by `text`
	 * only if `condition` is true. Condition uses JSON condition syntax as in @see \App\Condition.
	 *
	 * @param string $str
	 * @param \App\TextParser $textParser
	 * @return string|null
	 */
	public static function processIfs(string $str, \App\TextParser $textParser) {
		if ($str) {
			// process IF
			while (preg_match(self::IF_REGEXP, $str, $match) > 0) {
				$conditionString = $match['condition'];
				$conditionString = preg_replace(self::TAG_REMOVER_REGEXP, '', $conditionString);
				$conditionString = preg_replace(self::COMMENT_REMOVER_REGEXP, '', $conditionString);
				$ifTrue = $match['iftrue'];

				// parse and check condition
				$result = self::processIfCondition($conditionString, $textParser);

				$str = preg_replace(self::IF_REGEXP, $result ? $ifTrue : '', $str, 1);
			}
		}

		return $str;
	}

	/**
	 * Processes special text function - SPELLOUT[number], that returns number as text in Polish.
	 *
	 * @param string $str
	 * @return string|null
	 */
	public static function processSpellout($str) {
		if ($str) {
			$formatter = new \NumberFormatter("pl", \NumberFormatter::SPELLOUT);
			while (preg_match(self::SPELLOUT_REGEXP, $str, $match) > 0) {
				$number = $match['number'];
				if ($number === '' || $number === null) {
					$str = preg_replace(self::SPELLOUT_REGEXP, '', $str, 1);
					continue;
				}
				$number = is_numeric($number) ? floatval($number) : str_replace(',', '.', str_replace([' ', '.', ' ', '&nbsp;'], '', $number));
				$whole = floor($number);
				$decimals = round(($number - $whole), 2) * 100;

				$numberFormatted = $formatter->format($whole);

				if ($decimals > 0) {
					$numberFormatted .= " i $decimals/100";
				}
				
				$str = preg_replace(self::SPELLOUT_REGEXP, $numberFormatted, $str, 1);
			}
		}

		return $str;
	}

	/**
	 * Processes placeholders in format @@xxx@@ or <<xxx>> using Placeholders module
	 *
	 * @param string $str
	 * @param bool $useRaw
	 * @param string|null $moduleName
	 * @return string|null
	 */
	public static function processPlaceholders(string $str, bool $useRaw = false, ?string $moduleName = null) {
		if ($str) {
			$placeholders = (new \App\QueryGenerator('Placeholders'))
				->setFields(['placeholder', 'result_text']);
			if ($moduleName) {
				$placeholders = $placeholders->addCondition('mod_name', $moduleName, 'e', false);
			}
			$placeholders = $placeholders
				->createQuery()
				->select(['lower(placeholder)', 'result_text'])
				->createCommand()
				->queryAllByGroup(0);
			
			if ($useRaw) {
				$rawMethods = [];
				foreach($placeholders as $key => $value) {
					// read method from $value
					if (preg_match('/\$\((?<function>[a-zA-Z]+) :/', $value, $matches) === 1) {
						$method = $matches['function'];
				
						// check if raw exists
						if (!array_key_exists($method, $rawMethods)) {
							$rawMethods[$method] = method_exists('\App\TextParser', $method . 'Raw');
						}

						if ($rawMethods[$method]) {
							// replace if available
							$placeholders[$key] = str_replace("$($method :", "$({$method}Raw :", $value);
						}
					}
				}
			}

			return preg_replace_callback(self::PLACEHOLDER_REGEXP, function ($matches) use ($placeholders) {
				$placeholder = strtolower(preg_replace(self::TAG_REMOVER_REGEXP, '', $matches['placeholder']));
				if (!empty($placeholder) && array_key_exists($placeholder, $placeholders)) {
					return $placeholders[$placeholder];
				}
				return $matches[0];
			}, $str);
		}

		return $str;
	}
}
