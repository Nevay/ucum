<?php

/*
 * Generated from Ucum.g4 by ANTLR 4.13.2
 */

namespace Nevay\Ucum\Internal\Grammar {
	use Antlr\Antlr4\Runtime\Atn\ATN;
	use Antlr\Antlr4\Runtime\Atn\ATNDeserializer;
	use Antlr\Antlr4\Runtime\Atn\ParserATNSimulator;
	use Antlr\Antlr4\Runtime\Dfa\DFA;
	use Antlr\Antlr4\Runtime\Error\Exceptions\FailedPredicateException;
	use Antlr\Antlr4\Runtime\Error\Exceptions\NoViableAltException;
	use Antlr\Antlr4\Runtime\PredictionContexts\PredictionContextCache;
	use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
	use Antlr\Antlr4\Runtime\RuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\TokenStream;
	use Antlr\Antlr4\Runtime\Vocabulary;
	use Antlr\Antlr4\Runtime\VocabularyImpl;
	use Antlr\Antlr4\Runtime\RuntimeMetaData;
	use Antlr\Antlr4\Runtime\Parser;

	final class Ucum extends Parser
	{
		public const LPAREN = 1, RPAREN = 2, ANN = 3, DIGITS = 4, TIMES = 5, DIVIDE = 6, 
               SIGN = 7, PREFIXED_METRIC_ATOM = 8, METRIC_ATOM = 9, NON_METRIC_ATOM = 10, 
               ANY = 11;

		public const RULE_unit = 0, RULE_ucumExpr = 1, RULE_multiply = 2, RULE_expr = 3, 
               RULE_term = 4, RULE_element = 5, RULE_simpleUnit = 6, RULE_exponent = 7;

		/**
		 * @var array<string>
		 */
		public const RULE_NAMES = [
			'unit', 'ucumExpr', 'multiply', 'expr', 'term', 'element', 'simpleUnit', 
			'exponent'
		];

		/**
		 * @var array<string|null>
		 */
		private const LITERAL_NAMES = [
		];

		/**
		 * @var array<string>
		 */
		private const SYMBOLIC_NAMES = [
		    null, "LPAREN", "RPAREN", "ANN", "DIGITS", "TIMES", "DIVIDE", "SIGN", 
		    "PREFIXED_METRIC_ATOM", "METRIC_ATOM", "NON_METRIC_ATOM", "ANY"
		];

		private const SERIALIZED_ATN =
			[4, 1, 11, 66, 2, 0, 7, 0, 2, 1, 7, 1, 2, 2, 7, 2, 2, 3, 7, 3, 2, 4, 
		    7, 4, 2, 5, 7, 5, 2, 6, 7, 6, 2, 7, 7, 7, 1, 0, 1, 0, 1, 0, 1, 1, 
		    1, 1, 1, 1, 3, 1, 23, 8, 1, 1, 2, 1, 2, 1, 2, 1, 2, 3, 2, 29, 8, 2, 
		    1, 3, 1, 3, 5, 3, 33, 8, 3, 10, 3, 12, 3, 36, 9, 3, 1, 4, 1, 4, 3, 
		    4, 40, 8, 4, 1, 4, 5, 4, 43, 8, 4, 10, 4, 12, 4, 46, 9, 4, 1, 5, 1, 
		    5, 1, 5, 1, 5, 1, 5, 1, 5, 3, 5, 54, 8, 5, 1, 6, 1, 6, 1, 6, 3, 6, 
		    59, 8, 6, 1, 7, 3, 7, 62, 8, 7, 1, 7, 1, 7, 1, 7, 0, 0, 8, 0, 2, 4, 
		    6, 8, 10, 12, 14, 0, 1, 1, 0, 9, 10, 67, 0, 16, 1, 0, 0, 0, 2, 22, 
		    1, 0, 0, 0, 4, 28, 1, 0, 0, 0, 6, 30, 1, 0, 0, 0, 8, 37, 1, 0, 0, 
		    0, 10, 53, 1, 0, 0, 0, 12, 58, 1, 0, 0, 0, 14, 61, 1, 0, 0, 0, 16, 
		    17, 3, 2, 1, 0, 17, 18, 5, 0, 0, 1, 18, 1, 1, 0, 0, 0, 19, 20, 5, 
		    6, 0, 0, 20, 23, 3, 6, 3, 0, 21, 23, 3, 6, 3, 0, 22, 19, 1, 0, 0, 
		    0, 22, 21, 1, 0, 0, 0, 23, 3, 1, 0, 0, 0, 24, 25, 5, 5, 0, 0, 25, 
		    29, 3, 8, 4, 0, 26, 27, 5, 6, 0, 0, 27, 29, 3, 8, 4, 0, 28, 24, 1, 
		    0, 0, 0, 28, 26, 1, 0, 0, 0, 29, 5, 1, 0, 0, 0, 30, 34, 3, 8, 4, 0, 
		    31, 33, 3, 4, 2, 0, 32, 31, 1, 0, 0, 0, 33, 36, 1, 0, 0, 0, 34, 32, 
		    1, 0, 0, 0, 34, 35, 1, 0, 0, 0, 35, 7, 1, 0, 0, 0, 36, 34, 1, 0, 0, 
		    0, 37, 39, 3, 10, 5, 0, 38, 40, 3, 14, 7, 0, 39, 38, 1, 0, 0, 0, 39, 
		    40, 1, 0, 0, 0, 40, 44, 1, 0, 0, 0, 41, 43, 5, 3, 0, 0, 42, 41, 1, 
		    0, 0, 0, 43, 46, 1, 0, 0, 0, 44, 42, 1, 0, 0, 0, 44, 45, 1, 0, 0, 
		    0, 45, 9, 1, 0, 0, 0, 46, 44, 1, 0, 0, 0, 47, 54, 3, 12, 6, 0, 48, 
		    49, 5, 1, 0, 0, 49, 50, 3, 6, 3, 0, 50, 51, 5, 2, 0, 0, 51, 54, 1, 
		    0, 0, 0, 52, 54, 5, 3, 0, 0, 53, 47, 1, 0, 0, 0, 53, 48, 1, 0, 0, 
		    0, 53, 52, 1, 0, 0, 0, 54, 11, 1, 0, 0, 0, 55, 59, 5, 8, 0, 0, 56, 
		    59, 7, 0, 0, 0, 57, 59, 5, 4, 0, 0, 58, 55, 1, 0, 0, 0, 58, 56, 1, 
		    0, 0, 0, 58, 57, 1, 0, 0, 0, 59, 13, 1, 0, 0, 0, 60, 62, 5, 7, 0, 
		    0, 61, 60, 1, 0, 0, 0, 61, 62, 1, 0, 0, 0, 62, 63, 1, 0, 0, 0, 63, 
		    64, 5, 4, 0, 0, 64, 15, 1, 0, 0, 0, 8, 22, 28, 34, 39, 44, 53, 58, 
		    61];
		protected static $atn;
		protected static $decisionToDFA;
		protected static $sharedContextCache;

		public function __construct(TokenStream $input)
		{
			parent::__construct($input);

			self::initialize();

			$this->interp = new ParserATNSimulator($this, self::$atn, self::$decisionToDFA, self::$sharedContextCache);
		}

		private static function initialize(): void
		{
			if (self::$atn !== null) {
				return;
			}

			RuntimeMetaData::checkVersion('4.13.2', RuntimeMetaData::VERSION);

			$atn = (new ATNDeserializer())->deserialize(self::SERIALIZED_ATN);

			$decisionToDFA = [];
			for ($i = 0, $count = $atn->getNumberOfDecisions(); $i < $count; $i++) {
				$decisionToDFA[] = new DFA($atn->getDecisionState($i), $i);
			}

			self::$atn = $atn;
			self::$decisionToDFA = $decisionToDFA;
			self::$sharedContextCache = new PredictionContextCache();
		}

		public function getGrammarFileName(): string
		{
			return "Ucum.g4";
		}

		public function getRuleNames(): array
		{
			return self::RULE_NAMES;
		}

		public function getSerializedATN(): array
		{
			return self::SERIALIZED_ATN;
		}

		public function getATN(): ATN
		{
			return self::$atn;
		}

		public function getVocabulary(): Vocabulary
        {
            static $vocabulary;

			return $vocabulary = $vocabulary ?? new VocabularyImpl(self::LITERAL_NAMES, self::SYMBOLIC_NAMES);
        }

		/**
		 * @throws RecognitionException
		 */
		public function unit(): Context\UnitContext
		{
		    $localContext = new Context\UnitContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 0, self::RULE_unit);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(16);
		        $this->ucumExpr();
		        $this->setState(17);
		        $this->match(self::EOF);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function ucumExpr(): Context\UcumExprContext
		{
		    $localContext = new Context\UcumExprContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 2, self::RULE_ucumExpr);

		    try {
		        $this->setState(22);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::DIVIDE:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(19);
		            	$this->match(self::DIVIDE);
		            	$this->setState(20);
		            	$this->expr();
		            	break;

		            case self::LPAREN:
		            case self::ANN:
		            case self::DIGITS:
		            case self::PREFIXED_METRIC_ATOM:
		            case self::METRIC_ATOM:
		            case self::NON_METRIC_ATOM:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(21);
		            	$this->expr();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function multiply(): Context\MultiplyContext
		{
		    $localContext = new Context\MultiplyContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 4, self::RULE_multiply);

		    try {
		        $this->setState(28);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::TIMES:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(24);
		            	$this->match(self::TIMES);
		            	$this->setState(25);
		            	$this->term();
		            	break;

		            case self::DIVIDE:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(26);
		            	$this->match(self::DIVIDE);
		            	$this->setState(27);
		            	$this->term();
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expr(): Context\ExprContext
		{
		    $localContext = new Context\ExprContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 6, self::RULE_expr);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(30);
		        $this->term();
		        $this->setState(34);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::TIMES || $_la === self::DIVIDE) {
		        	$this->setState(31);
		        	$this->multiply();
		        	$this->setState(36);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function term(): Context\TermContext
		{
		    $localContext = new Context\TermContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 8, self::RULE_term);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(37);
		        $this->element();
		        $this->setState(39);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::DIGITS || $_la === self::SIGN) {
		        	$this->setState(38);
		        	$this->exponent();
		        }
		        $this->setState(44);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::ANN) {
		        	$this->setState(41);
		        	$this->match(self::ANN);
		        	$this->setState(46);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function element(): Context\ElementContext
		{
		    $localContext = new Context\ElementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 10, self::RULE_element);

		    try {
		        $this->setState(53);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::DIGITS:
		            case self::PREFIXED_METRIC_ATOM:
		            case self::METRIC_ATOM:
		            case self::NON_METRIC_ATOM:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(47);
		            	$this->simpleUnit();
		            	break;

		            case self::LPAREN:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(48);
		            	$this->match(self::LPAREN);
		            	$this->setState(49);
		            	$this->expr();
		            	$this->setState(50);
		            	$this->match(self::RPAREN);
		            	break;

		            case self::ANN:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(52);
		            	$this->match(self::ANN);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function simpleUnit(): Context\SimpleUnitContext
		{
		    $localContext = new Context\SimpleUnitContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 12, self::RULE_simpleUnit);

		    try {
		        $this->setState(58);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::PREFIXED_METRIC_ATOM:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(55);
		            	$localContext->prefixedAtom = $this->match(self::PREFIXED_METRIC_ATOM);
		            	break;

		            case self::METRIC_ATOM:
		            case self::NON_METRIC_ATOM:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(56);

		            	$localContext->atom = $this->input->LT(1);
		            	$_la = $this->input->LA(1);

		            	if (!($_la === self::METRIC_ATOM || $_la === self::NON_METRIC_ATOM)) {
		            		    $localContext->atom = $this->errorHandler->recoverInline($this);
		            	} else {
		            		if ($this->input->LA(1) === Token::EOF) {
		            		    $this->matchedEOF = true;
		            	    }

		            		$this->errorHandler->reportMatch($this);
		            		$this->consume();
		            	}
		            	break;

		            case self::DIGITS:
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(57);
		            	$localContext->digits = $this->match(self::DIGITS);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function exponent(): Context\ExponentContext
		{
		    $localContext = new Context\ExponentContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 14, self::RULE_exponent);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(61);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::SIGN) {
		        	$this->setState(60);
		        	$this->match(self::SIGN);
		        }
		        $this->setState(63);
		        $this->match(self::DIGITS);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}
	}
}

namespace Nevay\Ucum\Internal\Grammar\Context {
	use Antlr\Antlr4\Runtime\ParserRuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;
	use Antlr\Antlr4\Runtime\Tree\TerminalNode;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
	use Nevay\Ucum\Internal\Grammar\Ucum;
	use Nevay\Ucum\Internal\Grammar\UcumVisitor;

	class UnitContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return Ucum::RULE_unit;
	    }

	    public function ucumExpr(): ?UcumExprContext
	    {
	    	return $this->getTypedRuleContext(UcumExprContext::class, 0);
	    }

	    public function EOF(): ?TerminalNode
	    {
	        return $this->getToken(Ucum::EOF, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof UcumVisitor) {
			    return $visitor->visitUnit($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class UcumExprContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return Ucum::RULE_ucumExpr;
	    }

	    public function DIVIDE(): ?TerminalNode
	    {
	        return $this->getToken(Ucum::DIVIDE, 0);
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof UcumVisitor) {
			    return $visitor->visitUcumExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class MultiplyContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return Ucum::RULE_multiply;
	    }

	    public function TIMES(): ?TerminalNode
	    {
	        return $this->getToken(Ucum::TIMES, 0);
	    }

	    public function term(): ?TermContext
	    {
	    	return $this->getTypedRuleContext(TermContext::class, 0);
	    }

	    public function DIVIDE(): ?TerminalNode
	    {
	        return $this->getToken(Ucum::DIVIDE, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof UcumVisitor) {
			    return $visitor->visitMultiply($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExprContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return Ucum::RULE_expr;
	    }

	    public function term(): ?TermContext
	    {
	    	return $this->getTypedRuleContext(TermContext::class, 0);
	    }

	    /**
	     * @return array<MultiplyContext>|MultiplyContext|null
	     */
	    public function multiply(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(MultiplyContext::class);
	    	}

	        return $this->getTypedRuleContext(MultiplyContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof UcumVisitor) {
			    return $visitor->visitExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class TermContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return Ucum::RULE_term;
	    }

	    public function element(): ?ElementContext
	    {
	    	return $this->getTypedRuleContext(ElementContext::class, 0);
	    }

	    public function exponent(): ?ExponentContext
	    {
	    	return $this->getTypedRuleContext(ExponentContext::class, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ANN(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(Ucum::ANN);
	    	}

	        return $this->getToken(Ucum::ANN, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof UcumVisitor) {
			    return $visitor->visitTerm($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ElementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return Ucum::RULE_element;
	    }

	    public function simpleUnit(): ?SimpleUnitContext
	    {
	    	return $this->getTypedRuleContext(SimpleUnitContext::class, 0);
	    }

	    public function LPAREN(): ?TerminalNode
	    {
	        return $this->getToken(Ucum::LPAREN, 0);
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

	    public function RPAREN(): ?TerminalNode
	    {
	        return $this->getToken(Ucum::RPAREN, 0);
	    }

	    public function ANN(): ?TerminalNode
	    {
	        return $this->getToken(Ucum::ANN, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof UcumVisitor) {
			    return $visitor->visitElement($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SimpleUnitContext extends ParserRuleContext
	{
		/**
		 * @var Token|null $prefixedAtom
		 */
		public $prefixedAtom;

		/**
		 * @var Token|null $atom
		 */
		public $atom;

		/**
		 * @var Token|null $digits
		 */
		public $digits;

		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return Ucum::RULE_simpleUnit;
	    }

	    public function PREFIXED_METRIC_ATOM(): ?TerminalNode
	    {
	        return $this->getToken(Ucum::PREFIXED_METRIC_ATOM, 0);
	    }

	    public function METRIC_ATOM(): ?TerminalNode
	    {
	        return $this->getToken(Ucum::METRIC_ATOM, 0);
	    }

	    public function NON_METRIC_ATOM(): ?TerminalNode
	    {
	        return $this->getToken(Ucum::NON_METRIC_ATOM, 0);
	    }

	    public function DIGITS(): ?TerminalNode
	    {
	        return $this->getToken(Ucum::DIGITS, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof UcumVisitor) {
			    return $visitor->visitSimpleUnit($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExponentContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return Ucum::RULE_exponent;
	    }

	    public function DIGITS(): ?TerminalNode
	    {
	        return $this->getToken(Ucum::DIGITS, 0);
	    }

	    public function SIGN(): ?TerminalNode
	    {
	        return $this->getToken(Ucum::SIGN, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof UcumVisitor) {
			    return $visitor->visitExponent($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 
}