<?php

namespace Zheltikov\TypeAssert;

class TypeCheckerState
{
    /**
     * @var string[][]
     */
    protected array $report_stack;

    /**
     * @var bool
     */
    protected bool $reporting_enabled;

    protected int $frame;

    /**
     *
     */
    private function __construct()
    {
        $this->report_stack = [[]];
        $this->frame = 0;
        $this->setReportingEnabled();
    }

    // -------------------------------------------------------------------------

    /**
     * @return static
     */
    public static function create(): self
    {
        return new static();
    }

    // -------------------------------------------------------------------------

    /**
     * @param string $message
     * @param mixed ...$args
     * @return $this
     */
    public function appendReportStack(string $message, ...$args): self
    {
        if ($this->isReportingEnabled()) {
            $this->report_stack[$this->frame][] = vsprintf($message, $args);
        }
        return $this;
    }

    /**
     * @param string|null $message
     * @return $this
     */
    public function shiftReportStack(?string &$message = null): self
    {
        if ($this->isReportingEnabled()) {
            $message = array_pop($this->report_stack[$this->frame]);
        }
        return $this;
    }

    /**
     * @return string[]
     */
    public function getReportStack(): array
    {
        $stack = [];

        foreach ($this->report_stack as $frame) {
            foreach ($frame as $message) {
                $stack[] = $message;
            }
        }

        return $stack;
    }

    /**
     * @param bool $reporting_enabled
     * @return $this
     */
    public function setReportingEnabled(bool $reporting_enabled = true): self
    {
        $this->reporting_enabled = $reporting_enabled;
        return $this;
    }

    /**
     * @return bool
     */
    public function isReportingEnabled(): bool
    {
        return $this->reporting_enabled;
    }

    /**
     * @return $this
     */
    public function pushFrame(): self
    {
        if ($this->isReportingEnabled()) {
            $this->frame++;
            $this->report_stack[$this->frame] = [];
        }
        return $this;
    }

    /**
     * @return $this
     */
    public function popFrame(): self
    {
        if ($this->isReportingEnabled()) {
            if ($this->frame > 0) {
                unset($this->report_stack[$this->frame]);
                $this->frame--;
            } else {
                $this->frame = 0;
                $this->report_stack = [[]];
            }
        }
        return $this;
    }
}
