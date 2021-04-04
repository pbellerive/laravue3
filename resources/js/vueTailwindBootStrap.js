import TAlert from 'vue-tailwind/dist/t-alert';
import TButton from 'vue-tailwind/dist/t-button';
import TInput from 'vue-tailwind/dist/t-input';
import TInputGroup from 'vue-tailwind/dist/t-input-group';
import TRadio from 'vue-tailwind/dist/t-radio';
import TDialog from 'vue-tailwind/dist/t-dialog';
import TSelect from 'vue-tailwind/dist/t-select';
import TDatePicker from 'vue-tailwind/dist/t-datepicker';

const settings = {
  't-select': {
    component: TSelect,
    props: {
      fixedClasses: 'text-black block w-full pl-3 pr-10 py-2 transition duration-100 ease-in-out border rounded shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed',
      classes: 'text-black placeholder-gray-400 bg-white border-gray-300 focus:border-blue-500 ',
      variants: {
        danger: 'border-red-300 bg-red-50 placeholder-red-200 text-red-900',
        success: 'border-green-300 bg-green-50 placeholder-gray-400 text-green-900'
      }
    }
  },
  't-dialog': {
    component: TDialog,
    props: {
      fixedClasses: {
        overlay: 'overflow-auto scrolling-touch left-0 top-0 bottom-0 right-0 w-full h-full fixed',
        wrapper: 'relative mx-auto',
        modal: 'overflow-visible relative ',
        close: 'flex items-center justify-center',
        dialog: 'overflow-visible relative',
      },
      classes: {
        cancelButton: 'block px-4 py-2 transition duration-100 ease-in-out rounded shadow-sm text-white bg-red-400 border border-transparent rounded shadow-sm hover:bg-red-600 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed w-full max-w-xs',

        close: 'bg-gray-100 text-gray-600 rounded-full absolute right-0 top-0 -m-3 h-8 w-8 transition duration-100 ease-in-out hover:bg-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50',
        closeIcon: 'fill-current h-4 w-4',

        overlay: 'z-40 bg-black bg-opacity-50',
        wrapper: 'z-50 max-w-lg px-3 py-12',
        dialog: 'bg-white shadow rounded text-left',

        body: 'p-3 space-y-3',
        buttons: 'p-3 flex space-x-4 justify-center bg-gray-100 rounded-b',

        iconWrapper: 'bg-gray-100 flex flex-shrink-0 h-12 items-center justify-center rounded-full w-12 mx-auto',
        icon: 'w-6 h-6 text-gray-500',
        content: 'w-full flex justify-center flex-col',

        titleWrapper: '',
        title: 'text-lg font-semibold text-center',

        textWrapper: 'text-left w-full text-black',
        text: '',

        okButton: 'float-left block px-4 py-2 text-white transition duration-100 ease-in-out bg-green-jem-500 border border-transparent rounded shadow-sm hover:bg-green-jem-600 focus:border-green-jem-500 focus:ring-2 focus:ring-green-jem-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed w-full max-w-xs',

        inputWrapper: 'mt-3 flex items-center space-x-3',

        input: 'block w-full px-3 py-2 text-black placeholder-gray-400 transition duration-100 ease-in-out bg-white border border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed w-full',
        select: 'block w-full px-3 py-2 text-black placeholder-gray-400 transition duration-100 ease-in-out bg-white border border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50  disabled:opacity-50 disabled:cursor-not-allowed w-full',

        radioWrapper: 'flex items-center space-x-2',
        radio: 'text-blue-500 transition duration-100 ease-in-out border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 focus:ring-offset-0  disabled:opacity-50 disabled:cursor-not-allowed',
        radioText: '',

        checkboxWrapper: 'flex items-center space-x-2',
        checkbox: 'text-blue-500 transition duration-100 ease-in-out border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 focus:ring-offset-0  disabled:opacity-50 disabled:cursor-not-allowed',
        checkboxText: '',

        errorMessage: 'text-red-500 block text-sm',

        busyWrapper: 'absolute bg-opacity-50 bg-white flex h-full items-center justify-center left-0 top-0 w-full',
        busyIcon: 'animate-spin h-6 w-6 fill-current text-gray-500',

        overlayEnterClass: '',
        overlayEnterActiveClass: 'opacity-0 transition ease-out duration-100',
        overlayEnterToClass: 'opacity-100',
        overlayLeaveClass: 'transition ease-in opacity-100',
        overlayLeaveActiveClass: '',
        overlayLeaveToClass: 'opacity-0 duration-75',

        enterClass: '',
        enterActiveClass: '',
        enterToClass: '',
        leaveClass: '',
        leaveActiveClass: '',
        leaveToClass: '',
      }
    }
  },
  't-alert': {
    component: TAlert,
    props: {
      fixedClasses: {
        wrapper: 'relative flex items-center p-4 border-l-4  rounded shadow-sm',
        body: 'flex-grow',
        close: 'absolute relative flex items-center justify-center ml-4 flex-shrink-0 w-6 h-6 transition duration-100 ease-in-out rounded  focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50',
        closeIcon: 'fill-current h-4 w-4'
      },
      classes: {
        wrapper: 'bg-blue-50 border-blue-500',
        body: 'text-blue-700',
        close: 'text-blue-500 hover:bg-blue-200'
      },
      variants: {
        danger: {
          wrapper: 'bg-red-50 border-red-500',
          body: 'text-red-700',
          close: 'text-red-500 hover:bg-red-200'
        },
        success: {
          wrapper: 'bg-green-50 border-green-500',
          body: 'text-green-700',
          close: 'text-green-500 hover:bg-green-200'
        }
      }
    }
  },
  't-button': {
    component: TButton,
    props: {
      fixedClasses: 'text-gray-jem-800 mx-1 font-bold rounded-md block px-1 md:px-4 py-1 md:py-2 transition duration-100 ease-in-out focus:border-gray-jem-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed',
      classes: '',
      variants: {
        primary: 'bg-green-jem-500 text-white border border-green-jem-300 shadow-sm hover:bg-green-jem-600',
        secondary: 'bg-green-jem-300 text-white border border-green-jem-100 shadow-sm hover:bg-green-jem-400',
        link: 'text-green-jem-500 underline hover:text-green-jem-600',
        danger: 'text-white bg-red-400 border border-transparent rounded shadow-sm hover:bg-red-600',
        base: 'border border-gray-jem-300 hover:bg-gray-jem-300'
      }
    }
  },
  't-input': {
    component: TInput,
    props: {
      fixedClasses: 'block w-full px-3 py-2 transition duration-100 ease-in-out border rounded shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed',
      classes: 'text-black placeholder-gray-400 bg-white border-gray-300 focus:border-blue-500 ',
      variants: {
        danger: 'border-red-300 bg-red-50 placeholder-red-200 text-red-900',
        success: 'border-green-300 bg-green-50 placeholder-gray-400 text-green-900'
      }
    }
  },
  't-radio': {
    component: TRadio,
    props: {
      fixedClasses: 'transition duration-100 ease-in-out shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 focus:ring-offset-0  disabled:opacity-50 disabled:cursor-not-allowed',
      classes: 'text-blue-500 border-gray-300',
      variants: {
        error: 'text-red-500 border-red-300',
        success: 'text-green-500 border-green-300'
      }
    }
  },
  't-input-group': {
    component: TInputGroup,
    props: {
      fixedClasses: {
        wrapper: '',
        label: 'block mb-2',
        body: '',
        feedback: ' text-sm text-sm',
        description: 'text-gray-jem-400 text-sm'
      },
      classes: {
        wrapper: '',
        label: '',
        body: '',
        feedback: 'text-red-400',
        description: 'text-gray-jem-400'
      },
      variants: {
        danger: {
          label: 'text-red-500',
          feedback: 'text-red-500'
        },
        success: {
          label: 'text-green-jem-500',
          feedback: 'text-green-jem-500'
        }
      }
    }
  },
  't-datepicker': {
    component: TDatePicker,
    props: {
      fixedClasses: {
        navigator: 'flex',
        navigatorViewButton: 'flex items-center',
        navigatorViewButtonIcon: 'flex-shrink-0 h-5 w-5',
        navigatorViewButtonBackIcon: 'flex-shrink-0 h-5 w-5',
        navigatorLabel: 'flex items-center py-1',
        navigatorPrevButtonIcon: 'h-6 w-6 inline-flex',
        navigatorNextButtonIcon: 'h-6 w-6 inline-flex',
        inputWrapper: 'relative',
        viewGroup: 'inline-flex flex-wrap',
        view: 'w-64 text-black',
        calendarDaysWrapper: 'grid grid-cols-7',
        calendarHeaderWrapper: 'grid grid-cols-7',
        monthWrapper: 'grid grid-cols-4',
        yearWrapper: 'grid grid-cols-4',
        input: 'block w-full px-3 py-2 transition duration-100 ease-in-out border rounded shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed',
        clearButton: 'flex flex-shrink-0 items-center justify-center absolute right-0 top-0 m-2 h-6 w-6',
        clearButtonIcon: 'fill-current h-3 w-3'
      },
      classes: {
        wrapper: 'flex flex-col',
        dropdownWrapper: 'relative z-10',
        dropdown: 'origin-top-left absolute rounded shadow bg-white overflow-hidden mt-1',
        enterClass: '',
        enterActiveClass: 'transition ease-out duration-100 transform opacity-0 scale-95',
        enterToClass: 'transform opacity-100 scale-100',
        leaveClass: 'transition ease-in transform opacity-100 scale-100',
        leaveActiveClass: '',
        leaveToClass: 'transform opacity-0 scale-95 duration-75',
        inlineWrapper: '',
        inlineViews: 'rounded bg-white border mt-1 inline-flex',
        inputWrapper: '',
        input: 'text-black placeholder-gray-400 border-gray-300',
        clearButton: 'hover:bg-gray-100 rounded transition duration-100 ease-in-out text-gray-600',
        clearButtonIcon: '',
        viewGroup: '',
        view: '',
        navigator: 'pt-2 px-3',
        navigatorViewButton: 'transition ease-in-out duration-100 inline-flex cursor-pointer rounded-full px-2 py-1 -ml-1 hover:bg-gray-100',
        navigatorViewButtonIcon: 'fill-current text-gray-400',
        navigatorViewButtonBackIcon: 'fill-current text-gray-400',
        navigatorViewButtonMonth: 'text-gray-700 font-semibold',
        navigatorViewButtonYear: 'text-gray-500 ml-1',
        navigatorViewButtonYearRange: 'text-gray-500 ml-1',
        navigatorLabel: 'py-1',
        navigatorLabelMonth: 'text-gray-700 font-semibold',
        navigatorLabelYear: 'text-gray-500 ml-1',
        navigatorPrevButton: 'transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 rounded-full p-1 ml-2 ml-auto disabled:opacity-50 disabled:cursor-not-allowed',
        navigatorNextButton: 'transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-100 rounded-full p-1 -mr-1 disabled:opacity-50 disabled:cursor-not-allowed',
        navigatorPrevButtonIcon: 'text-gray-400',
        navigatorNextButtonIcon: 'text-gray-400',
        calendarWrapper: 'px-3 pt-2',
        calendarHeaderWrapper: '',
        calendarHeaderWeekDay: 'uppercase text-xs text-gray-500 w-8 h-8 flex items-center justify-center',
        calendarDaysWrapper: '',
        calendarDaysDayWrapper: 'w-full h-8 flex flex-shrink-0 items-center',
        otherMonthDay: 'text-sm rounded-full w-8 h-8 mx-auto hover:bg-blue-100 text-gray-400 disabled:opacity-50 disabled:cursor-not-allowed',
        emptyDay: '',
        inRangeFirstDay: 'text-sm bg-blue-500 text-white w-full h-8 rounded-l-full',
        inRangeLastDay: 'text-sm bg-blue-500 text-white w-full h-8 rounded-r-full',
        inRangeDay: 'text-sm bg-blue-200 w-full h-8 disabled:opacity-50 disabled:cursor-not-allowed',
        selectedDay: 'text-sm rounded-full w-8 h-8 mx-auto bg-blue-500 text-white disabled:opacity-50 disabled:cursor-not-allowed',
        activeDay: 'text-sm rounded-full bg-blue-100 w-8 h-8 mx-auto disabled:opacity-50 disabled:cursor-not-allowed',
        highlightedDay: 'text-sm rounded-full bg-blue-200 w-8 h-8 mx-auto disabled:opacity-50 disabled:cursor-not-allowed',
        day: 'text-sm rounded-full w-8 h-8 mx-auto hover:bg-blue-100 disabled:opacity-50 disabled:cursor-not-allowed',
        today: 'text-sm rounded-full w-8 h-8 mx-auto hover:bg-blue-100 disabled:opacity-50 disabled:cursor-not-allowed border border-blue-500',
        monthWrapper: 'px-3 pt-2',
        selectedMonth: 'text-sm rounded w-full h-12 mx-auto bg-blue-500 text-white',
        activeMonth: 'text-sm rounded w-full h-12 mx-auto bg-blue-100',
        month: 'text-sm rounded w-full h-12 mx-auto hover:bg-blue-100',
        yearWrapper: 'px-3 pt-2',
        year: 'text-sm rounded w-full h-12 mx-auto hover:bg-blue-100',
        selectedYear: 'text-sm rounded w-full h-12 mx-auto bg-blue-500 text-white',
        activeYear: 'text-sm rounded w-full h-12 mx-auto bg-blue-100'
      },
      variants: {
        danger: {
          input: 'border-red-300 bg-red-50 placeholder-red-200 text-red-900',
          clearButton: 'hover:bg-red-200 text-red-500'
        }
      }
    }
  }
};

export default settings;