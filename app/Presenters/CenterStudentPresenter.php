<?php

namespace App\Presenters;

use App\Models\Student;
use Laracasts\Presenter\Presenter;

class CenterStudentPresenter extends Presenter
{
    public function id()
    {
        $item = Student::find($this->xh);

        if ($item && $item->id == $this->xh) {
            return $this->xh;
        } else {
            return '<span class="text-danger">' . $this->xh . '</span>';
        }
    }

    public function name()
    {
        $item = Student::find($this->xh);

        if ($item && $item->name == $this->xm) {
            return $this->xm;
        } else {
            return '<span class="text-danger">' . $this->xm . '</span>';
        }
    }

    public function idnumber()
    {
        $item = Student::find($this->xh);

        if ($item && $item->idnumber == $this->sfzjh) {
            return $this->sfzjh;
        } else {
            return '<span class="text-danger">' . $this->sfzjh . '</span>';
        }
    }

    public function grade()
    {
        $item = Student::find($this->xh);

        if ($item && $item->grade == $this->dqszj) {
            return $this->dqszj;
        } else {
            return '<span class="text-danger">' . $this->dqszj . '</span>';
        }
    }

    public function duration()
    {
        $item = Student::find($this->xh);

        if ($item && $item->duration == $this->xz) {
            return $this->xz;
        } else {
            return '<span class="text-danger">' . $this->xz . '</span>';
        }
    }

    public function department()
    {
        $item = Student::find($this->xh);

        if ($item && $item->department_id == $this->dwh) {
            return optional($this->entity->department)->dwmc;
        } else {
            return '<span class="text-danger">' . optional($this->entity->department)->dwmc . '</span>';
        }
    }

    public function major()
    {
        $item = Student::find($this->xh);

        if ($item && $item->major_id == $this->zydm) {
            return optional($this->entity->major)->zymc;
        } else {
            return '<span class="text-danger">' . optional($this->entity->major)->zymc . '</span>';
        }
    }

    public function nation()
    {
        $item = Student::find($this->xh);

        if ($item && $item->nation_id == $this->mzm) {
            return optional($this->entity->nation)->mc;
        } else {
            return '<span class="text-danger">' . optional($this->entity->nation)->mc . '</span>';
        }
    }

    public function gender()
    {
        $item = Student::find($this->xh);

        if ($item && $item->gender_id == $this->xbm) {
            return optional($this->entity->gender)->mc;
        } else {
            return '<span class="text-danger">' . optional($this->entity->gender)->mc . '</span>';
        }
    }

    public function idtype()
    {
        $item = Student::find($this->xh);

        if ($item && $item->idtype_id == $this->sfzjlxm) {
            return optional($this->entity->idtype)->mc;
        } else {
            return '<span class="text-danger">' . optional($this->entity->idtype)->mc . '</span>';
        }
    }

    public function status()
    {
        $item = Student::find($this->xh);
        $status = ('在校' == $this->sfzx) ? 1 : 0;

        if ($item && $item->status == $status) {
            return $this->sfzx;
        } else {
            return '<span class="text-danger">' . $this->sfzx . '</span>';
        }
    }

    public function level()
    {
        $item = Student::find($this->xh);

        if ('教务管理系统' == $this->sjly) {
            $level = 0;
        } elseif ('研究生系统' == $this->sjly) {
            $level = 1;
        }

        if ($item && $item->level == $level) {
            return config('setting.level.' . $level);
        } else {
            return '<span class="text-danger">' . config('setting.level.' . $level) . '</span>';
        }
    }
}
