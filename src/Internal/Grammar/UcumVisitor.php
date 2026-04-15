<?php

/*
 * Generated from Ucum.g4 by ANTLR 4.13.2
 */

namespace Nevay\Ucum\Internal\Grammar;

use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;

/**
 * This interface defines a complete generic visitor for a parse tree produced by {@see Ucum}.
 */
interface UcumVisitor extends ParseTreeVisitor
{
	/**
	 * Visit a parse tree produced by {@see Ucum::unit()}.
	 *
	 * @param Context\UnitContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitUnit(Context\UnitContext $context);

	/**
	 * Visit a parse tree produced by {@see Ucum::ucumExpr()}.
	 *
	 * @param Context\UcumExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitUcumExpr(Context\UcumExprContext $context);

	/**
	 * Visit a parse tree produced by {@see Ucum::multiply()}.
	 *
	 * @param Context\MultiplyContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitMultiply(Context\MultiplyContext $context);

	/**
	 * Visit a parse tree produced by {@see Ucum::expr()}.
	 *
	 * @param Context\ExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExpr(Context\ExprContext $context);

	/**
	 * Visit a parse tree produced by {@see Ucum::term()}.
	 *
	 * @param Context\TermContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitTerm(Context\TermContext $context);

	/**
	 * Visit a parse tree produced by {@see Ucum::element()}.
	 *
	 * @param Context\ElementContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitElement(Context\ElementContext $context);

	/**
	 * Visit a parse tree produced by {@see Ucum::simpleUnit()}.
	 *
	 * @param Context\SimpleUnitContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitSimpleUnit(Context\SimpleUnitContext $context);

	/**
	 * Visit a parse tree produced by {@see Ucum::exponent()}.
	 *
	 * @param Context\ExponentContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExponent(Context\ExponentContext $context);
}