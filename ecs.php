<?php

use PHP_CodeSniffer\Standards\Generic\Sniffs\Arrays\DisallowLongArraySyntaxSniff;
use PHP_CodeSniffer\Standards\PSR12\Sniffs\Files\OpenTagSniff;
use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Arrays\ArrayIndentSniff;

use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\EmptyStatementSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\ForLoopShouldBeWhileLoopSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\ForLoopWithTestFunctionCallSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\JumbledIncrementerSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\UnconditionalIfStatementSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\UselessOverridingMethodSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\FixmeSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\TodoSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\EndFileNewlineSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\NoSpaceAfterCastSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Functions\CallTimePassByReferenceSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\CyclomaticComplexitySniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\NestingLevelSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\AbstractClassNamePrefixSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\CamelCapsFunctionNameSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\ConstructorNameSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\InterfaceNameSuffixSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\TraitNameSuffixSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\UpperCaseConstantNameSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\DeprecatedFunctionsSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\DisallowRequestSuperglobalSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\DiscourageGotoSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\NoSilencedErrorsSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Strings\UnnecessaryStringConcatSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\VersionControl\GitMergeConflictSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\WhiteSpace\DisallowTabIndentSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\WhiteSpace\ScopeIndentSniff;
use PHP_CodeSniffer\Standards\MySource\Sniffs\PHP\GetRequestDataSniff;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\Commenting\InlineCommentSniff;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\NamingConventions\ValidClassNameSniff;
use PHP_CodeSniffer\Standards\PSR1\Sniffs\Methods\CamelCapsMethodNameSniff;

use PHP_CodeSniffer\Standards\Squiz\Sniffs\NamingConventions\ValidVariableNameSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\DisallowMultipleAssignmentsSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\DisallowSizeFunctionsInLoopsSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\EvalSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\GlobalKeywordSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\InnerFunctionsSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\LowercasePHPFunctionsSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\NonExecutableCodeSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Scope\StaticThisUsageSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Strings\DoubleQuoteUsageSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\CastSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\LanguageConstructSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\LogicalOperatorSpacingSniff;
use PhpCsFixer\Fixer\Alias\EregToPregFixer;
use PhpCsFixer\Fixer\Alias\NoAliasFunctionsFixer;
use PhpCsFixer\Fixer\Alias\NoMixedEchoPrintFixer;

use PhpCsFixer\Fixer\ArrayNotation\NoMultilineWhitespaceAroundDoubleArrowFixer;
use PhpCsFixer\Fixer\ArrayNotation\NormalizeIndexBraceFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoTrailingCommaInSinglelineArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\NoWhitespaceBeforeCommaInArrayFixer;
use PhpCsFixer\Fixer\ArrayNotation\TrimArraySpacesFixer;
use PhpCsFixer\Fixer\ArrayNotation\WhitespaceAfterCommaInArrayFixer;
use PhpCsFixer\Fixer\Basic\NonPrintableCharacterFixer;
use PhpCsFixer\Fixer\Casing\NativeFunctionCasingFixer;
use PhpCsFixer\Fixer\CastNotation\LowercaseCastFixer;
use PhpCsFixer\Fixer\CastNotation\NoShortBoolCastFixer;
use PhpCsFixer\Fixer\CastNotation\ShortScalarCastFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\NoPhp4ConstructorFixer;
use PhpCsFixer\Fixer\ClassNotation\ProtectedToPrivateFixer;
use PhpCsFixer\Fixer\ClassNotation\SelfAccessorFixer;
use PhpCsFixer\Fixer\ClassNotation\VisibilityRequiredFixer;
use PhpCsFixer\Fixer\Comment\NoEmptyCommentFixer;
use PhpCsFixer\Fixer\Comment\SingleLineCommentStyleFixer;
use PhpCsFixer\Fixer\ControlStructure\IncludeFixer;
use PhpCsFixer\Fixer\ControlStructure\NoTrailingCommaInListCallFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUnneededControlParenthesesFixer;
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\FunctionNotation\FunctionTypehintSpaceFixer;
use PhpCsFixer\Fixer\Import\NoLeadingImportSlashFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\LanguageConstruct\CombineConsecutiveUnsetsFixer;
use PhpCsFixer\Fixer\NamespaceNotation\NoLeadingNamespaceWhitespaceFixer;
use PhpCsFixer\Fixer\NamespaceNotation\SingleBlankLineBeforeNamespaceFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\NewWithBracesFixer;
use PhpCsFixer\Fixer\Operator\ObjectOperatorWithoutWhitespaceFixer;
use PhpCsFixer\Fixer\Operator\StandardizeNotEqualsFixer;
use PhpCsFixer\Fixer\Operator\TernaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\UnaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Phpdoc\NoBlankLinesAfterPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\NoEmptyPhpdocFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocAnnotationWithoutDotFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocIndentFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoAccessFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoAliasTagFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoEmptyReturnFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoPackageFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoUselessInheritdocFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocOrderFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocScalarFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocSingleLineVarSpacingFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocTrimFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocVarWithoutNameFixer;
use PhpCsFixer\Fixer\PhpTag\BlankLineAfterOpeningTagFixer;
use PhpCsFixer\Fixer\PhpTag\LinebreakAfterOpeningTagFixer;
use PhpCsFixer\Fixer\ReturnNotation\NoUselessReturnFixer;
use PhpCsFixer\Fixer\Semicolon\NoEmptyStatementFixer;
use PhpCsFixer\Fixer\Semicolon\NoSinglelineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Semicolon\SemicolonAfterInstructionFixer;
use PhpCsFixer\Fixer\Semicolon\SpaceAfterSemicolonFixer;

use PhpCsFixer\Fixer\Strict\StrictParamFixer;
use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;
use PhpCsFixer\Fixer\Whitespace\BlankLineBeforeStatementFixer;
use PhpCsFixer\Fixer\Whitespace\NoSpacesAroundOffsetFixer;
use PhpCsFixer\Fixer\Whitespace\NoWhitespaceInBlankLineFixer;

use Symplify\CodingStandard\TokenRunner\Analyzer\FixerAnalyzer\IndentDetector;
use Symplify\EasyCodingStandard\ValueObject\Option;


return static function (ECSConfig $ecsConfig): void {
// A. full sets
$ecsConfig->sets([SetList::PSR_12]);
$services =$ecsConfig->services();
$services ->set(DeclareStrictTypesFixer::class)
    ->set(OpenTagSniff::class)
    ->set(DisallowLongArraySyntaxSniff::class)
    ->set(ArrayIndentSniff::class)
    ->set(DeprecatedFunctionsSniff::class)
    ->set(DisallowRequestSuperglobalSniff::class)
    ->set(DisallowTabIndentSniff::class)
    ->set(ScopeIndentSniff::class)
    ->set(GitMergeConflictSniff::class)
    ->set(NestingLevelSniff::class)
    ->set(EndFileNewlineSniff::class)
    ->set(UselessOverridingMethodSniff::class)
    ->set(AbstractClassNamePrefixSniff::class)
    ->set(InterfaceNameSuffixSniff::class)
    ->set(TraitNameSuffixSniff::class)
    ->set(UpperCaseConstantNameSniff::class)
    ->set(IndentDetector::class)
    ->set(EmptyStatementSniff::class)
    ->set(ForLoopShouldBeWhileLoopSniff::class)
    ->set(ForLoopWithTestFunctionCallSniff::class)
    ->set(JumbledIncrementerSniff::class)
    ->set(UnconditionalIfStatementSniff::class)
    ->set(TodoSniff::class)
    ->set(FixmeSniff::class)
    ->set(NoSpaceAfterCastSniff::class)
    ->set(CallTimePassByReferenceSniff::class)
    ->set(ConstructorNameSniff::class)
    ->set(CamelCapsFunctionNameSniff::class)
    ->set(DiscourageGotoSniff::class)
    ->set(NoSilencedErrorsSniff::class)
    ->set(GetRequestDataSniff::class)
    ->set(InlineCommentSniff::class)
    ->set(ValidClassNameSniff::class)
    ->set(CamelCapsMethodNameSniff::class)
    ->set(ValidVariableNameSniff::class)
    ->set(DisallowMultipleAssignmentsSniff::class)
    ->set(DisallowSizeFunctionsInLoopsSniff::class)
    ->set(EvalSniff::class)
    ->set(GlobalKeywordSniff::class)
    ->set(InnerFunctionsSniff::class)
    ->set(LowercasePHPFunctionsSniff::class)
    ->set(NonExecutableCodeSniff::class)
    ->set(StaticThisUsageSniff::class)
    ->set(DoubleQuoteUsageSniff::class)
    ->set(CastSpacingSniff::class)
    ->set(LanguageConstructSpacingSniff::class)
    ->set(LogicalOperatorSpacingSniff::class)
    ->set(BlankLineAfterOpeningTagFixer::class)
    ->set(CombineConsecutiveUnsetsFixer::class)
    ->set(EregToPregFixer::class)
    ->set(FunctionTypehintSpaceFixer::class)
    ->set(IncludeFixer::class)
    ->set(LinebreakAfterOpeningTagFixer::class)
    ->set(LowercaseCastFixer::class)
    ->set(NativeFunctionCasingFixer::class)
    ->set(NewWithBracesFixer::class)
    ->set(NoAliasFunctionsFixer::class)
    ->set(NoBlankLinesAfterPhpdocFixer::class)
    ->set(NoEmptyCommentFixer::class)
    ->set(NoEmptyPhpdocFixer::class)
    ->set(NoEmptyStatementFixer::class)
    ->set(NoLeadingImportSlashFixer::class)
    ->set(NoLeadingNamespaceWhitespaceFixer::class)
    ->set(NoMixedEchoPrintFixer::class)
    ->set(NoMultilineWhitespaceAroundDoubleArrowFixer::class)
    ->set(NoPhp4ConstructorFixer::class)
    ->set(NoShortBoolCastFixer::class)
    ->set(NoSinglelineWhitespaceBeforeSemicolonsFixer::class)
    ->set(NoSpacesAroundOffsetFixer::class)
    ->set(NoTrailingCommaInListCallFixer::class)
    ->set(NoTrailingCommaInSinglelineArrayFixer::class)
    ->set(NoUnneededControlParenthesesFixer::class)
    ->set(NoUnusedImportsFixer::class)
    ->set(NoUselessReturnFixer::class)
    ->set(NoWhitespaceBeforeCommaInArrayFixer::class)
    ->set(NoWhitespaceInBlankLineFixer::class)
    ->set(NonPrintableCharacterFixer::class)
    ->set(NormalizeIndexBraceFixer::class)
    ->set(ObjectOperatorWithoutWhitespaceFixer::class)
    ->set(PhpdocAnnotationWithoutDotFixer::class)
    ->set(PhpdocIndentFixer::class)
    ->set(PhpdocNoUselessInheritdocFixer::class)
    ->set(PhpdocNoAliasTagFixer::class)
    ->set(PhpdocNoEmptyReturnFixer::class)
    ->set(PhpdocNoAccessFixer::class)
    ->set(PhpdocNoPackageFixer::class)
    ->set(PhpdocOrderFixer::class)
    ->set(PhpdocScalarFixer::class)
    ->set(PhpdocSingleLineVarSpacingFixer::class)
    ->set(PhpdocTrimFixer::class)
    ->set(PhpdocVarWithoutNameFixer::class)
    ->set(ProtectedToPrivateFixer::class)
    ->set(SelfAccessorFixer::class)
    ->set(SemicolonAfterInstructionFixer::class)
    ->set(ShortScalarCastFixer::class)
    ->set(SingleBlankLineBeforeNamespaceFixer::class)
    ->set(SpaceAfterSemicolonFixer::class)
    ->set(SingleQuoteFixer::class)
    ->set(StandardizeNotEqualsFixer::class)
    ->set(StrictParamFixer::class)
    ->set(TernaryOperatorSpacesFixer::class)
    ->set(TrimArraySpacesFixer::class)
    ->set(UnaryOperatorSpacesFixer::class);

// B. standalone rule
$ecsConfig->ruleWithConfiguration(ArraySyntaxFixer::class, [
'syntax' => 'short',
]);
};